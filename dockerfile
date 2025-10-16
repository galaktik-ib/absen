# Gunakan image PHP 8.1 + FPM (sesuai versi Laragon kamu)
FROM php:8.1-fpm

# ------------------------------------------------------------
# 1️⃣ Install dependency sistem yang dibutuhkan Laravel & ekstensi PHP
# ------------------------------------------------------------
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

# ------------------------------------------------------------
# 2️⃣ Install Composer (buat install dependensi PHP)
# ------------------------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ------------------------------------------------------------
# 3️⃣ Set working directory di dalam container
# ------------------------------------------------------------
WORKDIR /var/www/html

# ------------------------------------------------------------
# 4️⃣ Copy semua file project ke dalam container
# ------------------------------------------------------------
COPY . .

# ------------------------------------------------------------
# 5️⃣ Install dependensi Laravel
# ------------------------------------------------------------
RUN composer install --no-dev --optimize-autoloader

# ------------------------------------------------------------
# 6️⃣ (Opsional) Build asset frontend (kalau pakai Tailwind/Vite)
# ------------------------------------------------------------
# RUN apt-get install -y nodejs npm
# RUN npm ci && npm run build

# ------------------------------------------------------------
# 7️⃣ Set permission supaya storage & cache bisa ditulis
# ------------------------------------------------------------
RUN chown -R www-data:www-data storage bootstrap/cache

# ------------------------------------------------------------
# 8️⃣ Laravel listen di port 10000 (Render butuh $PORT ini)
# ------------------------------------------------------------
EXPOSE 10000

# ------------------------------------------------------------
# 9️⃣ Jalankan Laravel pakai built-in server
# ------------------------------------------------------------
CMD php artisan serve --host=0.0.0.0 --port=10000
