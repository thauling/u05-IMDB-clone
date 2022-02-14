FROM php:8.1.0RC2-apache
RUN apt-get update && apt-get install -y build-essential git unzip default-mysql-client openssl locales zip curl

# so that we can install tailwind
RUN curl -sL https://deb.nodesource.com/setup_16.x  | bash -
RUN apt-get -y install nodejs

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo_mysql

