#!/bin/sh
#cd /var/www/symfony
composer install -n
bin/console doctrine:schema:update --force -n
#bin/console cache:clear --env=prod -n
echo "-----------------------------------------------"
echo "-----------------------------------------------"
echo "-----------------------------------------------"
echo "http://localhost:8081"
echo "-----------------------------------------------"
echo "-----------------------------------------------"
echo "-----------------------------------------------"
bin/console server:run 0.0.0.0:8081 -n -q

