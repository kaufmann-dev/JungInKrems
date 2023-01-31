# Jung in Krems
## Building the development environment
```
npm install
composer install

mv .env.example .env (edit accordingly)
php artisan migrate:fresh (only if using a new database)

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

mv .env.example .env (edit accordingly)
php artisan migrate:fresh (only if using a new database)

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
chmod -R 777 .
npm run build
```
### nginx config
```
location / {
   try_files $uri $uri/ /index.php?$query_string;
}
