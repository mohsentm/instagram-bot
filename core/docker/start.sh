#!/bin/bash

cd ${INSTALL_DIR:=/var/www/html}

# Check composer
if [[ ! -d vendor ]]; then
  # No vendor folder, run composer install then
  composer install --no-scripts --no-progress --no-suggest
fi

# Check .env
if [[ ! -f .env ]]; then
  # create .env and generate key
  cp .env.example .env
  artisan key:generate
fi

# Check the database connection
while artisan migrate:status | grep -q 'Connection refused'
do
 echo 'Waiting for database container getting up'
 sleep 1s
done

# Check the migration is exists
if artisan migrate:status | grep -q 'Migration table not found.'; then
 artisan migrate --seed
 artisan passport:install
else
    echo 'Migration table found.'
fi

#run the crontab
crond -f -L /dev/stdout &

#run supervisord
supervisord
supervisorctl reread
supervisorctl update
supervisorctl start all

/run.sh
