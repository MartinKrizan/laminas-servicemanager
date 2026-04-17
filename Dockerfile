FROM phpswoole/swoole:php8.5-dev

WORKDIR /var/www

COPY . .

RUN composer install