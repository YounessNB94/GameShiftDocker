# Image de base : PHP + Apache
FROM php:8.2-apache

# Installer l'extension PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Dossier de travail = DocumentRoot
WORKDIR /var/www/html

# Copier tout le code du front dans le conteneur
COPY . /var/www/html

# Quelques réglages Apache (optionnel mais propre)
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

EXPOSE 80

# Lancer Apache au premier plan (PID 1)
CMD ["apache2-foreground"]
