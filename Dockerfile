FROM php:8.4-fpm-alpine

WORKDIR /app

COPY . .

RUN apk --no-cache update \
    && apk add \
    git \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

EXPOSE 8080

CMD ["php-fpm"]
