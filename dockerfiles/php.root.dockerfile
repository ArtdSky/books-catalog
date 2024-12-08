FROM php:8.2-fpm-alpine

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN sed -i "s/user = www-data/user = root/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = root/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

RUN apk --update add --no-cache \
    git \
    unzip \
    libzip-dev \
    iputils-ping \
    libpq-dev \
    && docker-php-ext-install zip pdo_pgsql
    
USER root

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
