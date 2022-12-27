FROM php:8.2-cli-alpine3.17

ARG PHP_EXTENTIONS="@composer-2.0.2"

WORKDIR /var/www/project

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions \
    && install-php-extensions ${PHP_EXTENTIONS} \
    && apk update \
    && apk add nano \
    && apk upgrade

CMD ["sh", "-c", "tail -f /dev/null"]