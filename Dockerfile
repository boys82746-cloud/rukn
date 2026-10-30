FROM php:8.3-cli
RUN apt-get update && apt-get install -y git unzip curl \
 && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
 && apt-get install -y nodejs && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . .
RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
 && composer install --no-dev --optimize-autoloader --no-interaction \
 && npm install && npm run build && rm -rf node_modules
CMD sh -c "touch database/database.sqlite && php artisan migrate:fresh --seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"
