#!/bin/sh

# BUILD PROJECT FROM GIT

###################################################################################################################

FILE="public/git-pull.tmp"
if [ -f $FILE ]
then
  rm $FILE
  git reset --hard && git clean -fd && git pull
  php composer install
  php artisan cache:clear
  php artisan route:clear
  php artisan view:clear
  php artisan config:clear
  php artisan event:clear
  php artisan optimize:clear

  # MANAGING .env FILE; TODO: MAKE IT DYNAMIC BASED ON HOSTING OR SOMETHING ELSE
  rm .env
  cp .env.develop .env

  php artisan migrate

fi
