# Use official PHP + Apache image
FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy PHP files
COPY . /var/www/html/

# Enable mod_rewrite (optional)
RUN a2enmod rewrite

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose port 10000 (Render uses PORT env)
EXPOSE 10000

# Start Apache
CMD ["apache2-foreground"]
