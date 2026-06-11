FROM php:8.3-fpm

# Install system dependencies (Sintonizado para optimización de imágenes WebP)
RUN apt-get update && apt-get install -y \
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
    nodejs \
    npm \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Nginx y Supervisord
RUN apt-get update && apt-get install -y nginx supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy custom PHP uploads config
COPY docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

# Set working directory
WORKDIR /var/www

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --optimize-autoloader

# Copy application files
COPY . .

# =========================================================================
# MODIFICACIÓN PARA COOLIFY: Asegurar rutas de caché y un .env simulado
# para que los scripts post-autoload de Laravel no fallen durante el build.
# =========================================================================
RUN mkdir -p storage/framework/cache/data \
             storage/framework/app \
             storage/framework/sessions \
             storage/framework/views \
             storage/logs \
    && echo "APP_ENV=production" > .env \
    && echo "APP_KEY=base64:d3VubmVkZml4Y29vbGlmeWxhcmF2ZWxrZXlzZWN1cmU=" >> .env \
    && echo "VIEW_COMPILED_PATH=/var/www/storage/framework/views" >> .env

# Generate autoloader and run scripts (Ahora pasará sin problemas)
RUN composer dump-autoload --optimize \
    && composer run-script post-autoload-dump
# =========================================================================

# Build assets with Vite
RUN npm install && npm run build

# Configurar PHP-FPM socket y permisos
RUN mkdir -p /var/run/php \
    && sed -i 's|^;*listen =.*|listen = /var/run/php/php-fpm.sock|g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|^;*listen.mode =.*|listen.mode = 0666|g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|^;*listen.owner =.*|listen.owner = www-data|g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|^;*listen.group =.*|listen.group = www-data|g' /usr/local/etc/php-fpm.d/www.conf \
    && mkdir -p /var/www/storage/app/public /var/www/bootstrap/cache \
    && ln -sf /var/www/storage/app/public /var/www/public/storage \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Configurar Nginx (Código 3026 - Sintonía de Rutas y Configuración limpia)
RUN rm -f /etc/nginx/sites-enabled/default \
    && rm -f /etc/nginx/sites-available/default \
    && rm -f /etc/nginx/conf.d/default.conf \
    && mkdir -p /etc/nginx/sites-enabled

COPY docker/nginx/coolify.conf /etc/nginx/sites-available/default
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Configurar Supervisord
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Configurar proxy confianza para Coolify
ENV TRUSTED_PROXIES=*

# Expose port
EXPOSE 8000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
