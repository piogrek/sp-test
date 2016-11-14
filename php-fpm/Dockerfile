FROM php:7.0-cli



ADD start.sh /var/www/
RUN chmod +x /var/www/start.sh

RUN apt-get update
#RUN apt-get install curl
#RUN apk add --update curl
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR "/var/www/symfony"
#VOLUME ["/var/www/symfony"]
#CMD ["/var/www/start.sh"]
ENTRYPOINT ["/var/www/start.sh"]

