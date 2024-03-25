# Starter Kit for Laravel Project

## Installation

### Laravel
Require this package in your composer.json and update composer. This will download the package.

:warning: This package must be installed just after creating new laravel project. Installing in working project may cause overwriting your important files.

    composer require susheelbhai/laravel_starter_kit

## Configuration


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

Alternatively you can refresh the database and seed with the following commands

  ```
  php artisan migrate:fresh --seed
  
  ```

Change initial settings by runnung the command

  ```
  php artisan starter_kit:initial_settings
  ```



## Installation with single action

  create a new folder with the appropriate project name, open terminal and run the following command.

  ```
  laravel new project
  ```

  ```
  cd project
  composer require susheelbhai/laravel_starter_kit
  php artisan vendor:publish --tag="starter_kit" --force
  php artisan vendor:publish --tag="starter_kit_themes" --force
  php artisan migrate:fresh --seed
  php artisan starter_kit:initial_settings

  ``` 


### License

This Multi Auth Package is developed by susheelbhai for personal use software licensed under the [MIT license](http://opensource.org/licenses/MIT)
