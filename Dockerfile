FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . /app

# Install PHP & JS dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Expose port and start server
EXPOSE 10000
CMD php artisan serve --host 0.0.0.0 --port 10000
