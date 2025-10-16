# Gunakan image PHP + FPM
FROM php:8.2-fpm

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file project ke container
COPY . .

# Install dependensi PHP
RUN composer install --no-dev --optimize-autoloader

# (Opsional) build asset frontend (kalau pakai vite/tailwind)
# RUN npm ci && npm run build

# Set permission folder storage & cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Laravel listen di port 10000 (Render butuh ini)
EXPOSE 10000

# Jalankan server Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000
