FROM composer:2

WORKDIR /dont-do-drugs

COPY . .
RUN composer install

ENTRYPOINT ["php", "/dont-do-drugs/src/tool.php"]
