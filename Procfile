web: vendor/bin/heroku-php-apache2 public/
vite: yarn vite
worker: php artisan queue:work --sleep=3 --tries=3 --timeout=30
