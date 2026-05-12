# Use PHP with Apache
FROM php:8.2-apache

# Install MySQL connection tools
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy your folders (api, assets, auth, etc.) to the server
COPY . /var/www/html/

# Enable Apache Mod_Rewrite (helps with clean URLs)
RUN a2enmod rewrite

# Give the server permission to read your files
RUN chown -R www-data:www-data /var/www/html/

# Port 80 is standard for web traffic
EXPOSE 80
