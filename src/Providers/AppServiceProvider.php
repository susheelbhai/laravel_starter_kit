<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (config('app.env') == 'production') {
            $this->app->usePublicPath(base_path() . '/../public_html');
            $this->app->useStoragePath(base_path() . '/../public_html/storage');
        }
        if (config('app.env') == 'testing') {
            $this->app->usePublicPath(base_path() . '/../public_html');
            $this->app->useStoragePath(base_path() . '/../public_html/storage');
        }
        if (config('app.env') == 'live_testing') {
            $this->app->usePublicPath(base_path() . '/../public_html');
            $this->app->useStoragePath(base_path() . '/../public_html/storage');
        }
        if (config('app.env') == 'local') {
            $this->app->usePublicPath(base_path() . '/../public_html');
            $this->app->useStoragePath(base_path() . '/../public_html/storage');
        }

        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('relativeInclude', function ($args) {
            $args = Blade::stripParentheses($args);
    
            $viewBasePath = Blade::getPath();
            foreach ($this->app['config']['view.paths'] as $path) {
                if (substr($viewBasePath,0,strlen($path)) === $path) {
                    $viewBasePath = substr($viewBasePath,strlen($path));
                    break;
                }
            }
    
            $viewBasePath = dirname(trim($viewBasePath,'\/'));
            $args = substr_replace($args, $viewBasePath.'.', 1, 0);
            return "<?php echo \$__env->make({$args}, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
        });

        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/starter_kit/public_html/livewire/livewire.js', $handle);
        });
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/starter_kit/public_html/livewire/update', $handle);
        });
    }
}
