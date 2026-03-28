#!/bin/bash

PANEL_DIR="/var/www/pterodactyl"
BRANCH="1.0-develop"

echo "===== Pterodactyl Update Script ====="

cd $PANEL_DIR || exit

echo "Maintenance Mode aktivieren..."
php artisan down

echo "Fix permissions für gesamten Panel-Ordner..."
chown -R www-data:www-data $PANEL_DIR
chmod -R 775 storage bootstrap/cache

# Extra Fix für Laravel Cache/Views/Sessions
echo "Stelle sicher, dass alle Cache-Ordner existieren und beschreibbar sind..."
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
chown -R www-data:www-data storage/framework
chmod -R 775 storage/framework

echo "Alten Cache löschen..."
rm -rf storage/framework/cache/data/*

echo "Git Update als www-data..."
sudo -u www-data git pull origin $BRANCH

echo "Composer Dependencies installieren als www-data..."
sudo -u www-data composer install --no-dev --optimize-autoloader

echo "Datenbank Migration durchführen..."
php artisan migrate --seed --force

echo "Cache & Views komplett leeren als www-data..."
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan config:clear
sudo -u www-data php artisan view:clear
sudo -u www-data php artisan route:clear
sudo -u www-data php artisan optimize:clear

echo "Queue Worker neu starten..."
systemctl restart pteroq

echo "Panel wieder online..."
php artisan up

echo "===== Update fertig ====="
