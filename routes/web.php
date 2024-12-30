<?php

use App\Http\Controllers\SettingsController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\FrontEndController;
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

        Route::get('/profile', 'userProfile')->middleware('verified')->name('profile');

        Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::delete('/settings', [SettingsController::class, 'destroy'])->name('settings.destroy');


        //biodata controllers
        Route::prefix('/biodata')->controller(BiodataController::class)->name('biodata.')->group(function () {
            Route::get('/{user_id}', 'getSingleBiodata')->middleware('verified')->name('get');
            Route::post('/update_media_agreement', 'updateMediaAgreement')->middleware('verified')->name('post.update_media_agreement');
            Route::post('/update_gender', 'updateGender')->middleware('verified')->name('post.update_gender');
            Route::post('/update_personal_biodata', 'updatePersonalBiodata')->middleware('verified')->name('post.update_personal_biodata');
            Route::post('/update_religious_biodata', 'updateReligiousBiodata')->middleware('verified')->name('post.update_religious_biodata');
            Route::post('/update_family_biodata', 'updateFamilyBiodata')->middleware('verified')->name('post.update_family_biodata');
            Route::post('/update_deserved_biodata', 'updateDeservedBiodata')->middleware('verified')->name('post.update_deserved_biodata');
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


});
