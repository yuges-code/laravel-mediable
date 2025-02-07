# Laravel-mediable

![GitHub Release](https://img.shields.io/github/v/release/yuges-code/laravel-mediable)
![Packagist Downloads](https://img.shields.io/packagist/dt/yuges-code/laravel-mediable)
![GitHub License](https://img.shields.io/github/license/yuges-code/laravel-mediable)
![Packagist Stars](https://img.shields.io/packagist/stars/yuges-code/laravel-mediable)

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
