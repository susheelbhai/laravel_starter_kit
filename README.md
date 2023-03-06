## Multi Authentication System for Laravel

## Installation

### Laravel
Require this package in your composer.json and update composer. This will download the package and install breeze package.

:warning: This package must be installed just after creating new laravel project. Installing in working project may cause overwriting your important files

    composer require susheelbhai/laravel_starter_kit

## Configuration

### Service Provider

Register the service Provider in  `config/app.php`

  ```
  Susheelbhai\StarterKit\StarterKitServiceProvider::class,
  ```
  
### Vendor Publish

Publish all the required files using the following command 

  ```
  php artisan vendor:publish --tag="starter_kit" --force 
  ```  

Publish all the themes using the following command 

  ```
  php artisan vendor:publish --tag="starter_kit_themes" --force 
  ```  

### Migrate database

Migrate  databse tables and seed with the following commands

  ```
  php artisan migrate
  php artisan db:seed
  ```

### License

This Multi Auth Package is developed by susheelbhai for personal use software licensed under the [MIT license](http://opensource.org/licenses/MIT)
