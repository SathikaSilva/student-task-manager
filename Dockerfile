FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    sqlite3 \
    libsqlite3-dev \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring gd

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

# Touch sqlite database file & set permissions
RUN touch /app/database/database.sqlite
RUN chmod -R 777 /app/storage /app/database

# Expose port and start server
EXPOSE 10000
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 10000
