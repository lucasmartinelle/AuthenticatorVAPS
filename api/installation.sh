#!/bin/bash

cd /var/www/api

sed -i 's/secretkey/'$(echo $RANDOM | sha256sum | base64 | head -c 32 ; echo)'/' .env.local.php
sed -i 's/appsecret/'$(echo $RANDOM | sha256sum | base64 | head -c 32 ; echo)'/' .env.local.php

composer install --no-interaction

php bin/console doctrine:migrations:migrate --no-interaction