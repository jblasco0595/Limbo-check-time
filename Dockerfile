#Base image for the container
FROM php:7.2-apache
#Install GIT, GnuPG, NodeJS and NPM
RUN apt-get update && apt-get install -y git gnupg && \
    curl -sL https://deb.nodesource.com/setup_10.x | bash - && \
    apt-get install -y nodejs

#Add Laravel necessary php extensions
RUN apt-get install -y \
    unzip \
    vim \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-install -j$(nproc) zip mysqli pdo_mysql \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd
# Create working directory
RUN mkdir -p /var/www/html
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV APP_NAME "laravel7.3dockerized"
# Install composer from image. You may change it to the latest
COPY --from=composer:1.5 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
# Make laravel feel comfortable with mod-rewrite

RUN a2enmod headers && a2enmod rewrite && service apache2 restart

EXPOSE 80
EXPOSE 443
