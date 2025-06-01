# Starter Kit for Laravel Project

## Installation

### Laravel
Require this package in your composer.json and update composer. This will download the package.

:warning: This package must be installed just after creating new laravel project. Installing in working project may cause overwriting your important files.

    composer require susheelbhai/laravel_starter_kit

## Configuration


### Vendor Publish

Publish all the required files using one of the following command based on your frontend need

  For Blade Starter Kit
  ```
  php artisan vendor:publish --tag="blade_starter_kit" --force 
  ```  

  For React Starter Kit
  ```
  php artisan vendor:publish --tag="react_starter_kit" --force 
  ```  

Publish all the themes using the following command 

  ```
  php artisan vendor:publish --tag="starter_kit_themes" --force 
  ```  


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

### Install Other Required Package

```
npm install react-icons

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
  laravel new project
  ```

  #### With blade starter kit

  ```
  composer require susheelbhai/laravel_starter_kit
  php artisan vendor:publish --tag="blade_starter_kit" --force
  php artisan vendor:publish --tag="starter_kit_themes" --force
  php artisan starter_kit:initial_settings
  php artisan migrate:fresh --seed
  php artisan storage:link
  npm install react-icons
  npm run build
  npm run dev

  ``` 

  #### With react starter kit

  ```
  composer require susheelbhai/laravel_starter_kit
  php artisan vendor:publish --tag="react_starter_kit" --force
  php artisan starter_kit:initial_settings
  php artisan migrate:fresh --seed
  npm run build
  npm run dev

  ``` 

### License

This Laravel Starter Kit Package is developed by susheelbhai for personal use software licensed under the [MIT license](http://opensource.org/licenses/MIT)
