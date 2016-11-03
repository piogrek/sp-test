#!/bin/sh
cd /var/www/symfony
composer install
bin/console doctrine:schema:update --force
php-fpm -F
