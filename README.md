# Laravel-mediable
Package for easily uploading and attaching media files to Laravel eloquent models

## Installation

### Preparing the database
You need to publish the migration to create the media table:

```
php artisan vendor:publish --provider="Yuges\Mediable\Providers\MediableServiceProvider" --tag="mediable-migrations"
```

After that, you need to run migrations.

```
php artisan migrate
```

### Publishing the config file
Publishing the config file (`config/mediable.php`) is optional:

```
php artisan vendor:publish --provider="Yuges\Mediable\Providers\MediableServiceProvider" --tag="mediable-config"
```
