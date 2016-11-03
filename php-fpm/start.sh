#!/bin/sh
cd /var/www/symfony
composer install -n
bin/console doctrine:schema:update --force
php-fpm -F
