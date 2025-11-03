FROM php:8.4-fpm-bookworm

# Retrieve last version of install-php-extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync

# Install PHP Extensions (Laravel requirements)
RUN install-php-extensions bcmath
# ALREADY in image: ctype fileinfo json mbstring openssl pdo tokenizer xml

# Install optional PHP Extensions
RUN install-php-extensions \
    pcntl \
    sockets \
    zip

# Install nodejs and npm (for playwright - required by pest browser testing)
RUN mkdir /.npm
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash -
RUN apt-get install -y nodejs

# install Plawright (via npm) and dependencies
RUN npm i -g playwright && npx playwright install-deps chromium # firefox webkit

WORKDIR /var/www/html

# Set php.ini configurarion
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
COPY ./docker/php.ini /usr/local/etc/php/conf.d

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add github token for composer
ENV COMPOSER_HOME=/var/www/.composer
ARG COMPOSER_GITHUB_TOKEN
RUN composer config -g github-oauth.github.com ${COMPOSER_GITHUB_TOKEN}

# Use host user (to fix file permission). Required on Linux
ARG UID
RUN chown -R ${UID} /var/www/
RUN chown -R ${UID} /.npm
RUN mkdir /.cache && chown -R ${UID} /.cache
USER ${UID}

# Install Playwright browsers (as non-root user)
RUN npx playwright install chromium #firefox webkit

