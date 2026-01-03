# Use official PHP + Apache image
FROM php:8.2-apache

# Copy PHP files into container
COPY . /var/www/html/

# Enable mod_rewrite (optional)
RUN a2enmod rewrite

# Set proper permissions (optional)
RUN chown -R www-data:www-data /var/www/html/

# Expose port 10000 (Render uses PORT env)
EXPOSE 10000

# Start Apache in foreground
CMD ["apache2-foreground"]
