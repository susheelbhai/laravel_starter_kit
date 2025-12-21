<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FormsController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\Slider1Controller;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\UserQueryController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ImportantLinkController;
use App\Http\Controllers\Admin\ProductCategoryController;

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

        Route::name('forms.')->controller(FormsController::class)->prefix('forms')->group(function () {
            Route::get('/simple', 'simpleCreate')->name('simple');
            Route::get('/editor', 'editorCreate')->name('editor');
            Route::get('/date', 'dateCreate')->name('date');
            Route::get('/select', 'selectCreate')->name('select');
            Route::get('/file', 'fileCreate')->name('file');
            Route::get('/image', 'imageCreate')->name('image');


            Route::patch('/simple', 'storeSimpleForm')->name('simple.store');
            Route::patch('/editor', 'storeEditorForm')->name('editor.store');
            Route::get('/wizard', 'wizardForm')->name('wizard');
            Route::patch('/wizard', 'partialUpdateWizard')->name('wizard.partial_update');
            Route::patch('/wizard/store', 'submitWizard')->name('wizard.submit');

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
        Route::middleware('role:Super Admin')->group(function () {
            Route::resource('/admin', AdminController::class);
            Route::resource('/role', RoleController::class);
            Route::resource('/permission', PermissionController::class);
        });
        Route::resource('/slider1', Slider1Controller::class)->except(['show', 'destroy']);
        Route::resource('/slider', SliderController::class);
        Route::resource('/partner', PartnerController::class);
        Route::resource('/seller', SellerController::class);
        
        Route::resource('/user', UserController::class);
        Route::resource('/userQuery', UserQueryController::class);
        Route::resource('/important_links', ImportantLinkController::class);
        Route::resource('/team', TeamController::class);
        Route::resource('/testimonial', TestimonialController::class);
        Route::resource('/portfolio', PortfolioController::class);
        Route::resource('/service', ServiceController::class);
        Route::resource('/blog', BlogController::class);
        Route::resource('/faq', FaqController::class);
        Route::resource('/product_category', ProductCategoryController::class);
        Route::resource('/product', ProductController::class);

        Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
    });
    require __DIR__ . '/auth.php';
    require __DIR__ . '/settings.php';
});

