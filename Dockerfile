FROM trafex/php-nginx:latest

USER root
RUN apk --no-cache add php8-pdo_sqlite php8-sqlite3 php81-sqlite3

USER nobody