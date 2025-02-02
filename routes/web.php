<?php

use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\BackEndController;
use App\Http\Controllers\BiodataController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\Localization;
use App\Http\Controllers\FileManagerController;


require __DIR__.'/auth.php';


Route::get('/localization/{locale}', LocalizationController::class)->name('localization');


Route::middleware(Localization::class)->group(function(){


    // unauthenticated frontend routes
    Route::controller(FrontEndController::class)->name('frontend.')->group(function () {

        Route::get('/', 'homePage')->name('home');

        Route::get('/about', 'aboutPage')->name('about');

        Route::get('/terms', 'termsPage')->name('terms');

        Route::get('/opinions', 'opinionsPage')->name('opinions');

        Route::get('/contact', 'contactPage')->name('contact');

        Route::get('/biodata_search', 'biodataSearch')->name('biodata_search');

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
            Route::post('/update_hide_biodata', 'updateHideBiodata')->middleware('verified')->name('post.update_hide_biodata');
            Route::post('/onClickPermanentDelete', 'onClickPermanentDeleteUser')->middleware('verified')->name('post.onClickPermanentDelete');
            Route::post('/update_media_agreement', 'updateMediaAgreement')->middleware('verified')->name('post.update_media_agreement');
            Route::post('/update_gender', 'updateGender')->middleware('verified')->name('post.update_gender');
            Route::post('/update_personal_biodata', 'updatePersonalBiodata')->middleware('verified')->name('post.update_personal_biodata');
            Route::post('/update_religious_biodata', 'updateReligiousBiodata')->middleware('verified')->name('post.update_religious_biodata');
            Route::post('/update_family_biodata', 'updateFamilyBiodata')->middleware('verified')->name('post.update_family_biodata');
            Route::post('/update_deserved_biodata', 'updateDeservedBiodata')->middleware('verified')->name('post.update_deserved_biodata');
            Route::post('/update_others_biodata', 'updateOthersBiodata')->middleware('verified')->name('post.update_others_biodata');
        });


    });



    // Address Controllers
    Route::prefix('/address')->controller(AddressController::class)->name('address.')->group(function () {
        Route::post('/country_id/{country_id}', 'getDivisions')->name('getDivisionsByCountryId');
        Route::post('/division_id/{division_id}', 'getDistricts')->name('getDistrictsByDivisionId');
        Route::post('/district_id/{district_id}', 'getUpazilas')->name('getUpazilasByDistrictId');
        // Route::post('/upazila_name/{upazila_name}', 'getPostcodes')->name('getPostcodesByUpazilaName');
        Route::post('/upazila_name/{upazila_name}', 'getUnionParishads')->name('getUnionParishadsByUpazilaName');
    });


    // Mail Controllers
    Route::prefix('/mails')->controller(MailController::class)->name('mails.')->group(function () {
        Route::post('/contact', 'sendMail')->name('frontend.contact.post');
    });



    // backend routes
    Route::prefix('/admin')->controller(BackEndController::class)->name('backend.')->group(function () {
        Route::get('/', 'getDashboard')->middleware('is_admin')->name('dashboard');
        Route::get('/login', 'getLogin')->middleware('throttle:6,1')->name('login');
        Route::post('/login', 'postLogin')->middleware('throttle:6,1')->name('login.post');
        Route::post('/logout', 'adminLogout')->name('logout');

        // Route::post('/get_user_data', 'getUserData')->middleware('is_admin')->name('get_user_data');

        //backend biodata controllers
        Route::prefix('/biodata')->controller(BiodataController::class)->name('biodata.')->group(function () {
            Route::post('/single_approve', 'updateIsApprovedSingle')->middleware('is_admin')->name('single_approve');
            Route::post('/multiple_approve', 'updateIsApprovedMultiple')->middleware('is_admin')->name('multiple_approve');
            Route::post('/single_trash', 'updateInTrashSingle')->middleware('is_admin')->name('single_trash');
            Route::post('/multiple_trash', 'updateInTrashMultiple')->middleware('is_admin')->name('multiple_trash');

            Route::post('/onClickPermanentDelete', 'onClickPermanentDelete')->middleware('is_admin')->name('onClickPermanentDelete');

            Route::post('/take_action', 'takeAction')->middleware('is_admin')->name('take_action');
        });

        //biodata controllers
        Route::prefix('/biodata')->controller(BiodataController::class)->name('biodata.')->group(function () {
            Route::get('/{user_id}', 'getSingleBiodata')->middleware('is_admin')->name('get');
            Route::post('/update_media_agreement', 'updateMediaAgreement')->middleware('is_admin')->name('post.update_media_agreement');
            Route::post('/update_gender', 'updateGender')->middleware('is_admin')->name('post.update_gender');
            Route::post('/update_personal_biodata', 'updatePersonalBiodata')->middleware('is_admin')->name('post.update_personal_biodata');
            Route::post('/update_religious_biodata', 'updateReligiousBiodata')->middleware('is_admin')->name('post.update_religious_biodata');
            Route::post('/update_family_biodata', 'updateFamilyBiodata')->middleware('is_admin')->name('post.update_family_biodata');
            Route::post('/update_deserved_biodata', 'updateDeservedBiodata')->middleware('is_admin')->name('post.update_deserved_biodata');
            Route::post('/update_others_biodata', 'updateOthersBiodata')->middleware('is_admin')->name('post.update_others_biodata');
        });

        Route::fallback('backEndFallBack')->name('fallback');

    });


    Route::get('filemanager', [FileManagerController::class, 'index'])->middleware('is_admin')->name('filemanager');


    Route::fallback([FrontEndController::class, 'frontEndFallBack'])->name('frontend.fallback');


});
