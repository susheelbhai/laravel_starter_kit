# Starter Kit for Laravel Project

## Initial setup before installing the packagge
Before starting with this package, please do the needful changes as follows
 
 1. install new project using ```laravel new app_name```
 2. create a new folder named ```project``` inside the root directory of the project ```app_name/project```
 3. Move all the files and folders *except public* to the new created folder ```app_name/project```
 4. Rename **public** folder to ```public_html``` 
 5. Modify index file ```app_name/public_html/index.php``` from ```__DIR__.'/../``` to ```__DIR__.'/../project/```
 6. Go to project directory using ```cd app_name/project```


## Installation

### Laravel
Require this package in your composer.json and update composer. This will download the package and install breeze package.

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
### Final Step
Uncomment 2 line in ```app_name/project/app/Providers/AppServiceProvider.php```

```
$settings = Setting::where('id', 1)->first();
Config::set('settings', $settings);
```

Change initial settings by runnung the command
```
php artisan starter_kit:initial_settings
```

### License

This Multi Auth Package is developed by susheelbhai for personal use software licensed under the [MIT license](http://opensource.org/licenses/MIT)
