FROM php:8.4-fpm-alpine

# Update
RUN apk update

# Retrieve last version of install-php-extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync

# Install PHP Extensions (Laravel requirements)
RUN install-php-extensions bcmath
# ALREADY in image: ctype fileinfo json mbstring openssl pdo tokenizer xml

# Install optional PHP Extensions
RUN install-php-extensions \
    pdo_pgsql \
    zip

WORKDIR /var/www/html

# Set php.ini configurarion
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
COPY ./docker/php.ini /usr/local/etc/php/conf.d

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add github token for composer
ENV COMPOSER_HOME /var/www/.composer
ARG COMPOSER_GITHUB_TOKEN
RUN composer config -g github-oauth.github.com ${COMPOSER_GITHUB_TOKEN}

# Use host user (to fix file permission). Required on Linux
ARG UID
RUN chown -R ${UID} /var/www/
USER ${UID}

