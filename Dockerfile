# Étape 1 : Construction des assets Vite
FROM node:20 AS node-builder

WORKDIR /app

# Copier uniquement les fichiers nécessaires à Vite
COPY package*.json vite.config.js ./
COPY resources ./resources
COPY public ./public

# Installer et builder les fichiers frontend
RUN npm install && npm run build

# Étape 2 : Base Laravel avec Apache et PHP
FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

# Activer le module Apache rewrite
RUN a2enmod rewrite

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier Composer depuis une image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le projet complet
COPY . .

# Installer les dépendances Laravel (sans dev)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Copier les assets Vite compilés
COPY --from=node-builder /app/public/build ./public/build

# Donner les bons droits
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copier la configuration Apache personnalisée
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Exposer le port utilisé par Apache
EXPOSE 80

# Lancer Apache au démarrage
CMD ["apache2-foreground"]
