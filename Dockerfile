FROM dunglas/frankenphp:latest

RUN install-php-extensions \
    pdo_mysql \
    opcache

COPY . /app/public

RUN chown -R www-data:www-data /app/public

ENV SERVER_NAME=:8080
EXPOSE 8080
