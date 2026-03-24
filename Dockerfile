FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    zip unzip git libzip-dev curl

RUN docker-php-ext-install pdo pdo_mysql zip

COPY . /var/www/html

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Enable rewrite
RUN a2enmod rewrite

# Set Laravel public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# ✅ FIX: DO NOT TOUCH Apache PORT FILES
# Just expose correct port
EXPOSE 80

# Permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 storage bootstrap/cache