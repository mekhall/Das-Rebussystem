FROM trafex/php-nginx:latest

USER root
RUN apk --no-cache add php8-pdo_sqlite --repository http://dl-cdn.alpinelinux.org/alpine/v3.16/community/ php8-sqlite3 php81-sqlite3

USER nobody