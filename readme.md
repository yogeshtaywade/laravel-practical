## Install Project Steps

Clone the project repository by running the command below
```bash
https://github.com/yogeshtaywade/laravel-practical.git
```
After cloning,run:

```bash
composer install
```

Duplicate `.env.example` and rename it `.env`
```bash
We need to set below details in .env file
- FILESYSTEM_DRIVER=public
```

Then run:

```bash
php artisan key:generate
```
#### Database Migrations

Be sure to fill in your database details in your `.env` file before running the migrations:

```bash
php artisan migrate
```

Storage link
```
php artisan storage:link
```

Seed data:
```
php artisan db:seed
```

And finally, start the application:

```bash
php artisan serve
```