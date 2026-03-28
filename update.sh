#!/bin/bash

echo "===== Pterodactyl Update Script ====="

echo "Maintenance Mode aktivieren..."
php artisan down

echo "Git Update..."
git pull origin main

echo "Composer Dependencies installieren..."
composer install --no-dev --optimize-autoloader

echo "Datenbank Migration..."
php artisan migrate --seed --force

echo "Cache leeren..."
php artisan optimize:clear

echo "Queue Worker neu starten..."
systemctl restart pteroq

echo "Panel wieder online..."
php artisan up

echo "===== Update fertig ====="
