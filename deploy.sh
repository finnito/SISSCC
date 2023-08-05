#!/bin/bash

#cd /srv/sisscc.lesueur.nz/
cd /volume1/web/sisscc.lesueur.nz/

sudo git pull origin
sudo -u http composer install --profile

sudo -u http php artisan migrate --path=vendor/anomaly/streams-platform/migrations/application
sudo -u http php artisan migrate --all-addons
sudo -u http php artisan assets:clear
sudo -u http php artisan view:clear
sudo -u http php artisan httpcache:clear

sudo chown -R http:http ./
sudo chmod -R ug+rwx storage bootstrap/cache;
sudo -u http composer dump-autoload --profile
