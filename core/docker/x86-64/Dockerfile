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
   php7-exif \
   dcron;

RUN chsh -s /bin/bash www-data

COPY ./ $INSTALL_DIR

COPY ./artisan.sh /usr/local/bin/artisan
RUN chmod +x /usr/local/bin/artisan

WORKDIR $INSTALL_DIR

# Add cron job
ADD ./docker/crontab /etc/cron.d/bot-cron
RUN chmod 0644 /etc/cron.d/bot-cron \
    && crontab /etc/cron.d/bot-cron
RUN crond -f -L /dev/stdout &
