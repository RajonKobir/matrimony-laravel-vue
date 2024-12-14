<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\BiodataController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\Localization;


require __DIR__.'/auth.php';


Route::get('/localization/{locale}', LocalizationController::class)->name('localization');


Route::middleware(Localization::class)->group(function(){


    // unauthenticated frontend routes
    Route::controller(FrontEndController::class)->name('frontend.')->group(function () {

        Route::get('/', 'homePage')->name('home');

        Route::get('/about', 'aboutPage')->name('about');

        Route::get('/faq', 'faqPage')->name('faq');

        Route::get('/instructions', 'instructionsPage')->name('instructions');

        Route::get('/contact', 'contactPage')->name('contact');

    });


    // authenticated frontend routes
    Route::controller(FrontEndController::class)->name('user.')->middleware('auth')->group(function () {

        Route::get('/dashboard', 'userDashboard')->middleware('verified')->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


        //biodata controllers
        Route::prefix('/biodata')->controller(BiodataController::class)->name('biodata.')->group(function () {
            Route::get('/{user_id}', 'getSingleBiodata')->middleware('verified')->name('get');
            Route::post('/', 'partialCreateOrUpdate')->middleware('verified')->name('post');
        });


    });



    // Address Controllers
    Route::prefix('/address')->controller(AddressController::class)->name('address.')->group(function () {
        Route::post('/country_id/{country_id}', 'getDivisions')->name('getDivisionsByCountryId');
        Route::post('/division_id/{division_id}', 'getDistricts')->name('getDistrictsByDivisionId');
        Route::post('/district_id/{district_id}', 'getUpazilas')->name('getUpazilasByDistrictId');
        Route::post('/upazila_name/{upazila_name}', 'getPostcodes')->name('getPostcodesByUpazilaName');
    });


    // Mail Controllers
    Route::prefix('/mails')->controller(MailController::class)->name('mails.')->group(function () {
        Route::post('/contact', 'sendMail')->name('frontend.contact.post');
    });



    // Admin Controller
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
        Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');

        Route::group(['middleware' => 'is_admin'], function () {
            Route::get('/', function () {
                return view('admin.welcome');
            })->name('adminDashboard');

        });

        Route::post('logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');

    });

});
