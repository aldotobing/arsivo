# Gunakan image PHP dengan Apache
FROM php:8.1-apache

# Update dan install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    apache2 \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Aktifkan mod yang diperlukan
RUN a2enmod rewrite headers

# Set working directory
WORKDIR /var/www/html

# Copy konfigurasi Apache
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Set listening port ke 8000
RUN echo "Listen 8000" > /etc/apache2/ports.conf

# Copy semua file proyek
COPY . .

# Set permission untuk .env
RUN chown www-data:www-data /var/www/html/.env \
    && chmod 644 /var/www/html/.env

# Set permission untuk storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && mkdir -p /var/www/html/vendor/mpdf/mpdf/tmp \
    && chown -R www-data:www-data /var/www/html/vendor/mpdf/mpdf/tmp \
    && chmod -R 775 /var/www/html/vendor/mpdf/mpdf/tmp

# File .env sudah dicopy dari host saat build

# Expose port 8000
EXPOSE 8000

# Start Apache
CMD ["apache2-foreground"]
