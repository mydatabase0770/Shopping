# Stage 1: Build Frontend Assets
FROM node:20 as frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Application Setup
FROM php:8.2-cli

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libbrotli-dev \
    && pecl install swoole \
    && docker-php-ext-enable swoole \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Copy built assets from frontend stage
COPY --from=frontend /app/public/build /var/www/public/build
COPY --from=frontend /app/package.json /var/www/package.json
COPY --from=frontend /app/package-lock.json /var/www/package-lock.json

# Install PHP dependencies (using --no-dev for production)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 8000
EXPOSE 8000

# Start command
# We use a custom entrypoint or just run the octane command
RUN chmod +x /var/www/entrypoint.sh
CMD ["/var/www/entrypoint.sh"]
