# Étape 1 : Construire l'application
FROM composer:2 as build

WORKDIR /app

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Étape 2 : Image finale avec PHP, Apache
FROM php:8.2-apache

# Installer les extensions PHP nécessaires à Laravel
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd \
    --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Copier les fichiers Laravel
COPY --from=build /app /var/www/html

# Activer mod_rewrite
RUN a2enmod rewrite

# Configuration Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copier un fichier .htaccess pour que Laravel fonctionne avec Apache
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
CMD ["apache2-foreground"]
