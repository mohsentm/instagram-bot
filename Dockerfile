FROM becopay/alpine-nginx-php

LABEL maintainer="mail@mohsenhosseini.info"
LABEL version="1.0.0"
LABEL description="Instagram bot 1.0.0"

ENV INSTALL_DIR /var/www/html
ENV COMPOSER_HOME /var/www/.composer/

ADD ./php.ini /etc/php7/php.ini

ADD ./nginx.conf /etc/nginx/conf.d/default.conf

RUN chsh -s /bin/bash www-data

ADD ./ $INSTALL_DIR
ADD ./.env.example $INSTALL_DIR/.env

RUN cd $INSTALL_DIR && composer install

RUN chown -R www-data:www-data /var/www

RUN cd $INSTALL_DIR \
    && find . -type d -exec chmod 770 {} \; \
    && find . -type f -exec chmod 660 {} \;

COPY ./artisan.sh /usr/local/bin/artisan
RUN chmod +x /usr/local/bin/artisan

WORKDIR $INSTALL_DIR