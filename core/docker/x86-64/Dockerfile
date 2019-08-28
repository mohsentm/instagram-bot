FROM mohsentm/alpine-nginx-php

LABEL maintainer="mail@mohsenhosseini.info"
LABEL version="1.0.0"
LABEL description="Instagram bot 1.0.0"

ENV INSTALL_DIR /var/www/html
ENV COMPOSER_HOME /var/www/.composer/

COPY ./docker/x86-64/php.ini /etc/php7/php.ini

COPY ./docker/x86-64/nginx.conf /etc/nginx/conf.d/default.conf

RUN apk add --update \
   ffmpeg \
   php7-fileinfo \
   php7-exif;

RUN chsh -s /bin/bash www-data

COPY ./ $INSTALL_DIR
#COPY ./.env.example $INSTALL_DIR/.env

#RUN cd $INSTALL_DIR && composer install && php artisan key:generate

COPY ./artisan.sh /usr/local/bin/artisan
RUN chmod +x /usr/local/bin/artisan

WORKDIR $INSTALL_DIR
