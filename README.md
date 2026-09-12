# Jung in Krems

Requires PHP 8.5 with the Laravel extensions and the PDO driver for your database, Composer 2.10+, and Node.js 24+. Use current patch releases. The application uses Laravel 13, Inertia 3, Svelte 5, Vite 8, Tailwind CSS 4, and Bootstrap 5.

## Development

Install the locked dependencies, including the frontend build tools:

```sh
composer install
npm ci --include=dev
cp .env.development.example .env
php artisan key:generate
```

Edit `.env` for your local database and mail configuration, then run:

```sh
php artisan migrate
npm run dev
```

In a separate terminal, start Laravel with `php artisan serve`.

## Verification

```sh
composer validate --strict
php vendor/bin/phpunit
npm run build
composer audit
npm audit --include=dev
```

The PHP tests use an in-memory SQLite database and require `pdo_sqlite`. They cover page rendering, registration, login and password rehashing, logout, Sanctum tokens, email verification, dashboard access, and event updates.

## Production

Configure the web server to serve the `public` directory. On the first installation, copy `.env.production.example` to `.env`, configure the database and mail settings, and generate an application key with `php artisan key:generate`. Keep the existing key when updating an installation.

Install dependencies and build assets:

```sh
composer install --no-dev --optimize-autoloader
npm ci --include=dev
npm run build
php artisan migrate --force
php artisan optimize
```

Give the PHP process write access to `storage`, `bootstrap/cache`, and `public/images/uploads` using appropriate ownership and group permissions.

Deploy from `main`, the repository's default and only permanent branch. Update any deployment service or script that still references `prod` to use `main`.

To update an existing installation, use `git pull --ff-only origin main`, then rerun the installation and build commands above. Restart long-running PHP workers after upgrading. Laravel 13 uses JSON session serialization in this application, so users must sign in again after this upgrade.

### NGINX configuration

```nginx
server {
    client_max_body_size 128M;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```

### PHP configuration

```ini
post_max_size = 136M
upload_max_filesize = 136M
```
