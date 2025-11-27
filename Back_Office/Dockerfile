FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# Copier tout le Back Office
COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]
