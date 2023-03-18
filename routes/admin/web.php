<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
// use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserQueryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ImportantLinkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth_admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/icons', function(){
        return view('admin.theme.icons');
    } )->name('icons');
    
    Route::name('profile.')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
    });

    Route::name('settings.')->controller(SettingController::class)->prefix('setting')->group( function() {
        Route::get('/general', 'generalSettings')->name('general');
        Route::get('/advanced', 'advanceSettings')->name('advanced');
        Route::post('/general', 'generalSettingsUpdate');
        Route::post('/advanced', 'advanceSettingsUpdate');
    });

    Route::name('pages.')->controller(PagesController::class)->prefix('pages')->group( function() {
        Route::get('/homePage', 'homePage')->name('homePage');
        Route::post('/homePage', 'updateHomePage')->name('updateHomePage');
        Route::get('/aboutPage', 'aboutPage')->name('aboutPage');
        Route::post('/aboutPage', 'updateAboutPage')->name('updateAboutPage');
        Route::get('/contactPage', 'contactPage')->name('contactPage');
        Route::post('/contactPage', 'updateContactPage')->name('updateContactPage');
    });

    Route::resource('/slider', SliderController::class);
    Route::resource('/partner', PartnerController::class);
    Route::resource('/userQuery', UserQueryController::class);
    Route::resource('/important_links', ImportantLinkController::class);

    // Route::resource('/business', BusinessController::class);
    // Route::post('/business/approve', [BusinessController::class,'approve'])->name('business.approve');

    Route::resource('/important_links', ImportantLinkController::class);
    
    
});

require __DIR__.'/auth.php';
