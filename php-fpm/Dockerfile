FROM alpine:3.4

MAINTAINER Vincent Composieux <vincent.composieux@gmail.com>



RUN apk add --update \
    php5-fpm \
        php5-apcu \
        php5-curl \
        php5-gd \
        php5-cli \
        php5-ctype \
        php5-iconv \
        php5-imagick \
        php5-json \
        php5-intl \
        php5-mcrypt \
        php5-mysql \
        php5-opcache \
        php5-openssl \
        php5-pdo \
        php5-pdo_mysql \
        php5-common \
        php5-dev \
        php5-mysqli \
        php5-phar \
        php5-xml \
        php5-dom \
        php5-zlib

RUN rm -rf /var/cache/apk/* && rm -rf /tmp/*

RUN apk add --update curl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


ADD symfony.ini /etc/php5/fpm/conf.d/
ADD symfony.ini /etc/php5/cli/conf.d/

ADD symfony.pool.conf /etc/php5/fpm.d/

WORKDIR /var/www/symfony
VOLUME ["/var/www/symfony"]
CMD ["composer", "install"]

CMD ["php-fpm", "-F"]

EXPOSE 9000
EXPOSE 9001
