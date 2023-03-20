# Jung in Krems
## Development
### Building the development environment
```
npm install && composer install

mv .env.develoment.example .env.develoment (edit variables)
php artisan migrate:fresh (only if using a new database)

npm run dev
php artisan serve
```
## Production
### Building the production environment
```
npm install && composer install

mv .env.production.example .env.production (edit variables)
php artisan migrate:fresh (only if using a new database)

chmod -R 777 && npm run build
```
### Updating the production environment
```
git reset --hard && git pull origin prod && chmod -R 777 . && npm run build
```
### Necessary configurations
#### NGINX configuration file
```
server {
   client_max_body_size 128M;
   location / {
      try_files $uri $uri/ /index.php?$query_string;
   }
}
```
#### PHP configuration file
```
post_max_size = 136M
upload_max_filesize = 136M
```