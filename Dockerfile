FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html/

# Enable Apache mod_rewrite
RUN a2enmod rewrite
# Install system dependencies
RUN apt-get update && apt-get install -y \
  libicu-dev \
  libzip-dev \
  libmariadb-dev \
  unzip zip \
  libpng-dev \
  libjpeg-dev \
  libjpeg62-turbo-dev

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Install PHP extensions
RUN docker-php-ext-install intl pdo_mysql zip gd

RUN docker-php-ext-configure gd -enable-gd --with-jpeg \ 
  && docker-php-ext-install -j$(nproc) gd



# # Need apache configuration instructions? Set "Servername" directive globally, change DocumentRoot to working directory, allow changes in .htaccess
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# # Install CakePHP
# RUN composer create-project --prefer-dist cakephp/app:^5.0 .

# # Set permissions
# RUN chown -R www-data:www-data /var/www/html

# # Configure Apache to use the webroot folder
# RUN sed -i 's!/var/www/html!/var/www/html/webroot!g' /etc/apache2/sites-available/000-default.conf
