FROM php:7.1-cli

MAINTAINER AbdElKader Bouadjadja

COPY . /usr/src/
WORKDIR /usr/src/

RUN apt-get update && apt-get install -y git && apt-get install unzip && apt-get install zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

CMD [ "vendor/bin/phpunit"]