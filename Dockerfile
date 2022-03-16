FROM php:7.4-fpm-alpine

RUN apk add --update \
    python3 \
    py-pip \
    git \
    libxslt-dev \
    autoconf \
    libtool \
    g++ \
    bash \
    make

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

ARG xdebug
ARG xdebug_remote_host="127.0.0.1"

#default port for xdebug 3 is 9003!!!!!
RUN if [ "$xdebug" != "" ] ; then \
    apk add php7-pecl-xdebug \
      && echo "zend_extension=$(find /usr/lib/php7 -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
      && echo "[xdebug]" >> /usr/local/etc/php/conf.d/xdebug.ini \
      && echo "xdebug.client_host=$xdebug_remote_host" >> /usr/local/etc/php/conf.d/xdebug.ini \
      && echo "xdebug.mode=develop,debug,coverage" >> /usr/local/etc/php/conf.d/xdebug.ini \
    ; fi

WORKDIR /app
COPY ./entrypoint.sh /opt/entrypoint.sh

ENTRYPOINT ["/bin/sh", "/opt/entrypoint.sh"]
