FROM php:8.2-apache

WORKDIR /var/www/html/

# Configuration d'Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Installation 'lipzip-dev' nécessaire pour l'extension 'zip' de PHP
RUN apt-get update && \
    apt-get install -y \
        libzip-dev

# Installation + activation extension PHP pdo
RUN docker-php-ext-install pdo

# Installation + activation extension PHP pdo_mysql
RUN docker-php-ext-install pdo_mysql

# Installation + activation extension PHP mysqli (nécessaire pour PHPMyAdmin)
RUN docker-php-ext-install mysqli

# Installation + activation extension PHP zip
RUN docker-php-ext-install zip

# Installation + activation extension PHP mongodb
RUN apt-get install libssl-dev
RUN apt-get install pkg-config
RUN pecl install mongodb
RUN docker-php-ext-enable mongodb

# Installation du module 'mod_rewrite' pour pouvoir utiliser RewriteEngine dans .htaccess
RUN a2enmod rewrite

# Installation composer
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Installation dépendances avec Composer
COPY ./composer.* ./

RUN composer update
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction

COPY ./ ./

RUN composer dump-autoload --optimize

# Exposer port 80
EXPOSE 80