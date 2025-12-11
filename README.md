# Starter Kit for Laravel Project

## Installation

### Laravel
Require this package in your composer.json and update composer. This will download the package.

:warning: This package must be installed just after creating new laravel project. Installing in working project may cause overwriting your important files.

    composer require susheelbhai/laravel_starter_kit

## Configuration

### Initial Settings
Change initial settings by runnung the command

  ```
  php artisan starter_kit:initial_settings

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

### Final Settings
Change Final settings by runnung the command

  ```
  php artisan starter_kit:final_settings

  ```

### Create a build

Make production build

  ```
  npm run build

  ```

run development environment

  ```
  npm run dev
  
  ```

### Link your storage folder to public folder

Make production build

  ```
  php artisan storage:link

  ```


## Installation with single action

  create a new folder with the appropriate project name, open terminal and run the following command.

  ```
  laravel new
  
  ```


  #### navigate to the directory and run the following commands

  ```
  composer require susheelbhai/laravel_starter_kit
  php artisan starter_kit:initial_settings
  php artisan migrate:fresh --seed
  php artisan starter_kit:final_settings
  php artisan storage:link
  npm run build
  npm run dev

  ``` 


### License

This Laravel Starter Kit Package is developed by susheelbhai for personal use software licensed under the [MIT license](http://opensource.org/licenses/MIT)
