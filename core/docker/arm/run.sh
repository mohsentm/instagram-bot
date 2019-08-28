#!/bin/sh

[ -f /run-pre.sh ] && /run-pre.sh

if [ ! -d /var/www/html ] ; then
  mkdir -p /var/www/html
  chown :www-data /var/www/html
fi

# start php-fpm
mkdir -p /var/log/php-fpm
php-fpm7

# start nginx
mkdir -p /var/log/nginx
mkdir -p /tmp/nginx
chown nginx /tmp/nginx
nginx
