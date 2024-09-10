FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
  libicu-dev \
  libzip-dev \
  zip \
  unzip

# Install PHP extensions
RUN docker-php-ext-install intl pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Install CakePHP
RUN composer create-project --prefer-dist cakephp/app:^5.0 .

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Configure Apache to use the webroot folder
RUN sed -i 's!/var/www/html!/var/www/html/webroot!g' /etc/apache2/sites-available/000-default.conf
