FROM trafex/php-nginx:latest AS rebusrally_root

USER root
RUN apk --no-cache add php8-pdo_sqlite --repository http://dl-cdn.alpinelinux.org/alpine/v3.16/community/ php8-sqlite3 php81-sqlite3

FROM rebusrally_root AS rebusrally
USER nobody