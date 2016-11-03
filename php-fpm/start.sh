#!/bin/sh
cd /var/www/symfony
composer install -n
bin/console doctrine:schema:update --force
bin/console cache:clear --env=prod
php-fpm -F
