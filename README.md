# Jugendliches Krems
## Building the development environment
```
npm install
composer install

mv .env.example .env
php artisan migrate:fresh

npm run dev
php artisan serve
```
### .env
- set `APP_ENV=local`
- update `MAIL` variables
- update `DB` variables
## Building the production environment
```
npm install
composer install

mv .env.example .env
php artisan migrate:fresh

chmod -R 777
npm run build
```
### .env
- set `APP_ENV=production`
- update `MAIL` variables
- update `DB` variables
### Applaying changes to the production environment
```
git reset --hard
git pull origin master
npm run build
```