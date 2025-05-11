<?php

use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TermsController;
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

        Route::get('/terms', 'termsPage')->name('terms');

        Route::get('/opinions', 'opinionsPage')->name('opinions');

        // Route::get('/contact', 'contactPage')->name('contact');

        Route::get('/biodata_search', 'biodataSearch')->name('biodata_search');

    });


    // authenticated frontend routes
    Route::controller(FrontEndController::class)->name('user.')->middleware('auth')->group(function () {

        Route::get('/profile', 'userProfile')->middleware('verified')->name('profile');

        Route::get('/likes', 'userLikes')->middleware('verified')->name('likes');

        Route::get('/proposals', 'userProposals')->middleware('verified')->name('proposals');

        Route::get('/packages', 'userPackages')->middleware('verified')->name('packages');

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

            Route::post('/update_single_items', 'updateSingleItems')->middleware('verified')->name('post.update_single_items');

            Route::post('/update_personal_biodata', 'updatePersonalBiodata')->middleware('verified')->name('post.update_personal_biodata');
            Route::post('/update_religious_biodata', 'updateReligiousBiodata')->middleware('verified')->name('post.update_religious_biodata');
            Route::post('/update_family_biodata', 'updateFamilyBiodata')->middleware('verified')->name('post.update_family_biodata');
            Route::post('/update_deserved_biodata', 'updateDeservedBiodata')->middleware('verified')->name('post.update_deserved_biodata');
            Route::post('/update_others_biodata', 'updateOthersBiodata')->middleware('verified')->name('post.update_others_biodata');

            Route::post('/biodata_duplication', 'biodataDuplication')->middleware('verified')->name('post.biodata_duplication');
            Route::post('/edit_request', 'onClickEditRequest')->middleware('verified')->name('post.edit_request');

        });


        // likes routes
        Route::prefix('/likes')->controller(LikeController::class)->name('likes.')->group(function () {

            Route::post('/single_like', 'singleLike')->middleware('verified')->name('single_like');
            Route::post('/single_dislike', 'singleDisLike')->middleware('verified')->name('single_dislike');

        });

        // proposals routes
        Route::prefix('/proposals')->controller(ProposalController::class)->name('proposals.')->group(function () {

            Route::post('/single_propose', 'singlePropose')->middleware('verified')->name('single_propose');
            Route::post('/single_oppose', 'singleOppose')->middleware('verified')->name('single_oppose');
            Route::post('/single_accept', 'singleAccept')->middleware('verified')->name('single_accept');
            Route::post('/single_cancel', 'singleCancel')->middleware('verified')->name('single_cancel');

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
        // Route::post('/contact', 'contactUs')->name('frontend.contact.post');
        Route::post('/proposals', 'proposalNotifications')->middleware(['auth', 'verified'])->name('backend.proposals.post');
    });


    // backend routes
    Route::prefix('/admin')->controller(BackEndController::class)->name('backend.')->group(function () {
        Route::get('/', 'getDashboard')->middleware('is_admin')->name('dashboard');
        Route::get('/login', 'getLogin')->middleware('throttle:6,1')->name('login');
        Route::post('/login', 'postLogin')->middleware('throttle:6,1')->name('login.post');
        Route::post('/logout', 'adminLogout')->middleware('is_admin')->name('logout');

        // Route::post('/get_user_data', 'getUserData')->middleware('is_admin')->name('get_user_data');

        //backend biodata controllers
        Route::prefix('/biodata')->controller(BiodataController::class)->name('biodata.')->group(function () {
            Route::post('/single_approve', 'updateIsApprovedSingle')->middleware('is_admin')->name('single_approve');
            Route::post('/multiple_approve', 'updateIsApprovedMultiple')->middleware('is_admin')->name('multiple_approve');
            Route::post('/single_trash', 'updateInTrashSingle')->middleware('is_admin')->name('single_trash');
            Route::post('/multiple_trash', 'updateInTrashMultiple')->middleware('is_admin')->name('multiple_trash');

            Route::post('/onClickPermanentDelete', 'onClickPermanentDelete')->middleware('is_admin')->name('onClickPermanentDelete');

            Route::post('/take_action', 'takeAction')->middleware('is_admin')->name('take_action');

            Route::post('/approve_edit_request', 'onClickApproveEditRequest')->middleware('is_admin')->name('approve_edit_request');
            Route::post('/cancel_edit_request', 'onClickCancelEditRequest')->middleware('is_admin')->name('cancel_edit_request');

            Route::post('/check_unique_biodata_code', 'checkUniqueBiodataCode')->middleware('is_admin')->name('check_unique_biodata_code');

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

        // terms routes
        Route::prefix('/terms')->controller(TermsController::class)->name('terms.')->group(function () {
            Route::post('/store', 'store')->middleware('is_admin')->name('store');
            Route::post('/destroy/{id}', 'destroy')->middleware('is_admin')->name('destroy');
            Route::post('/update', 'update')->middleware('is_admin')->name('update');
        });

        // proposals routes
        Route::prefix('/proposals')->controller(ProposalController::class)->name('proposals.')->group(function () {

            Route::post('/single_propose', 'singlePropose')->middleware('is_admin')->name('single_propose');
            Route::post('/single_oppose', 'singleOppose')->middleware('is_admin')->name('single_oppose');
            Route::post('/single_accept', 'singleAccept')->middleware('is_admin')->name('single_accept');
            Route::post('/single_cancel', 'singleCancel')->middleware('is_admin')->name('single_cancel');

        });

        Route::fallback('backEndFallBack')->name('fallback');

    });


    Route::get('filemanager', [FileManagerController::class, 'index'])->middleware('is_admin')->name('filemanager');


    Route::fallback([FrontEndController::class, 'frontEndFallBack'])->name('frontend.fallback');


});
