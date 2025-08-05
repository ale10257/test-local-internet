FROM php:8.1-fpm

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN apt-get update && apt-get install -y git openssl zip unzip procps imagemagick
RUN install-php-extensions \
        soap \
        zip \
        curl \
        gd \
        iconv \
        intl \
        mbstring \
        pdo_mysql \
        imagick \
        xdebug
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ARG UID
ARG GID
ARG UNAME

RUN usermod  --uid $UID $UNAME && groupmod --gid $GID $UNAME && usermod -md /home/$UNAME $UNAME && chown -R $UID:$GID /home/$UNAME
USER "${UID}:${GID}"
