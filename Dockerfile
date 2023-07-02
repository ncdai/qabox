FROM php:7.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY ./qabox /var/www/html/

RUN a2enmod rewrite

EXPOSE 80

ENTRYPOINT ["apache2-foreground"]
