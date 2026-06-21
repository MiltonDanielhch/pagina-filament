# ==========================================
# ETAPA 1: Node.js (Compilación de Assets)
# ==========================================
FROM node:20-alpine AS frontend-builder
WORKDIR /app

# Aprovechar el caché para los módulos de node
COPY package.json package-lock.json* ./
RUN --mount=type=cache,target=/root/.npm \
    npm clean-install

# Copiar el resto de archivos necesarios para Vite / Tailwind v4
COPY vite.config.js tailwind.config.js* postcss.config.js* ./
COPY resources/ ./resources/
COPY app/ ./app/

# Compilar assets de producción (Filament v5 + Vite)
RUN npm run build

# ==========================================
# ETAPA 2: Configuración de la Imagen Final
# ==========================================
FROM php:8.2-fpm

# Instalar todas las dependencias del sistema en UN SOLO paso usando Caché APT
RUN --mount=type=cache,target=/var/cache/apt,sharing=locked \
    --mount=type=cache,target=/var/lib/apt,sharing=locked \
    apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar configuración personalizada de subidas de PHP
COPY docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www

# Copiar archivos de Composer para aprovechamiento de Caché
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --optimize-autoloader

# Copiar los archivos de la aplicación (Menos el frontend crudo)
COPY . .

# Traer los assets YA COMPILADOS desde la etapa de Node (Ahorra capas y herramientas innecesarias)
COPY --from=frontend-builder /app/public/build ./public/build

# =========================================================================
# CONFIGURACIÓN PARA COOLIFY (Estructura interna y .env ficticio)
# =========================================================================
RUN mkdir -p storage/framework/cache/data \
             storage/framework/app \
             storage/framework/sessions \
             storage/framework/views \
             storage/logs \
    && echo "APP_ENV=production" > .env \
    && echo "APP_KEY=base64:d3VubmVkZml4Y29vbGlmeWxhcmF2ZWxrZXlzZWN1cmU=" >> .env \
    && echo "VIEW_COMPILED_PATH=/var/www/storage/framework/views" >> .env

# Optimizar el Autoloader de Composer ejecutando los comandos de Filament v5
RUN composer dump-autoload --optimize \
    && composer run-script post-autoload-dump

# Configurar sockets de PHP-FPM y permisos estructurales
RUN mkdir -p /var/run/php \
    && sed -i 's|^;*listen =.*|listen = /var/run/php/php-fpm.sock|g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|^;*listen.mode =.*|listen.mode = 0666|g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|^;*listen.owner =.*|listen.owner = www-data|g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|^;*listen.group =.*|listen.group = www-data|g' /usr/local/etc/php-fpm.d/www.conf \
    && mkdir -p /var/www/storage/app/public /var/www/bootstrap/cache \
    && ln -sf /var/www/storage/app/public /var/www/public/storage \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Configuración limpia de Nginx
RUN rm -f /etc/nginx/sites-enabled/default \
    && rm -f /etc/nginx/sites-available/default \
    && rm -f /etc/nginx/conf.d/default.conf \
    && mkdir -p /etc/nginx/sites-enabled

COPY docker/nginx/coolify.conf /etc/nginx/sites-available/default
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ENV TRUSTED_PROXIES=*
EXPOSE 8000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
