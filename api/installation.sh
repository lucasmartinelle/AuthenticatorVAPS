#!/bin/bash

cd /var/www/api

cat .env.local.php | sed 's/secretkey/'$(date +%s | sha256sum | base64 | head -c 32 ; echo)'/g' > .env.local.php

composer install --no-interaction

php bin/console doctrine:migrations:migrate --no-interaction