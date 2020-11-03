#!/bin/bash

set -eux

cd ~/qanda/backend
php artisan migrate --force
php artisan config:cache