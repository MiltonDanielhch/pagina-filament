FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Nginx y Supervisord
RUN apt-get update && apt-get install -y nginx supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --optimize-autoloader

# Copy application files
COPY . .

# Generate autoloader and run scripts
RUN composer dump-autoload --optimize \
    && composer run-script post-autoload-dump

# Build assets with Vite
RUN npm install && npm run build

# Configurar PHP-FPM socket y permisos
RUN mkdir -p /var/run/php \
    && sed -i 's|^;*listen =.*|listen = /var/run/php/php-fpm.sock|g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|^;*listen.mode =.*|listen.mode = 0666|g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|^;*listen.owner =.*|listen.owner = www-data|g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|^;*listen.group =.*|listen.group = www-data|g' /usr/local/etc/php-fpm.d/www.conf \
    && mkdir -p /var/www/storage /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Configurar Nginx
RUN rm /etc/nginx/sites-enabled/default
COPY docker/nginx/coolify.conf /etc/nginx/conf.d/default.conf

# Configurar Supervisord
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port
EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
