<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\Slider1Controller;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\UserQueryController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ImportantLinkController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Middleware\HandleInertiaRequests;

Route::middleware(['web', HandleInertiaRequests::class])->group(function () {
    Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::name('settings.')->controller(SettingController::class)->prefix('setting')->group(function () {
            Route::get('/general', 'generalSettings')->name('general');
            Route::get('/advanced', 'advanceSettings')->name('advanced');
            Route::patch('/general', 'generalSettingsUpdate');
            Route::patch('/advanced', 'advanceSettingsUpdate');
        });

        Route::name('pages.')->controller(PagesController::class)->prefix('pages')->group(function () {
            Route::get('/homePage', 'homePage')->name('homePage');
            Route::patch('/homePage', 'updateHomePage')->name('updateHomePage');
            Route::get('/aboutPage', 'aboutPage')->name('aboutPage');
            Route::patch('/aboutPage', 'updateAboutPage')->name('updateAboutPage');
            Route::get('/contactPage', 'contactPage')->name('contactPage');
            Route::patch('/contactPage', 'updateContactPage')->name('updateContactPage');
            Route::get('/tncPage', 'tncPage')->name('tncPage');
            Route::patch('/tncPage', 'updateTncPage')->name('updateTncPage');
            Route::get('/privacyPage', 'privacyPage')->name('privacyPage');
            Route::patch('/privacyPage', 'updatePrivacyPage')->name('updatePrivacyPage');
            Route::get('/refundPage', 'refundPage')->name('refundPage');
            Route::patch('/refundPage', 'updateRefundPage')->name('updateRefundPage');
        });
        Route::resource('/slider1', Slider1Controller::class)->except(['show', 'destroy']);
        Route::resource('/slider', SliderController::class);
        Route::resource('/partner', PartnerController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/userQuery', UserQueryController::class);
        Route::resource('/important_links', ImportantLinkController::class);
        Route::resource('/team', TeamController::class);
        Route::resource('/testimonial', TestimonialController::class);
        Route::resource('/portfolio', PortfolioController::class);
        Route::resource('/service', ServiceController::class);
        Route::resource('/blog', BlogController::class);
        Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
    });
});

require __DIR__ . '/auth.php';
