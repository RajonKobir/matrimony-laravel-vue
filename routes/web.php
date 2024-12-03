<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Auth\Admin\AdminAuthController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\Localization;


Route::get('/localization/{locale}', LocalizationController::class)->name('localization');


Route::middleware(Localization::class)->group(function(){

    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'translations' => __('frontend'),
            'locale' => session('localization', config('app.locale')),
            'locales' => config('localization.locales'),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    })->name('frontend.home');

    Route::get('/about', function () {
        return Inertia::render('Frontend/About', [
            'translations' => __('frontend'),
            'locale' => session('localization', config('app.locale')),
            'locales' => config('localization.locales'),
        ]);
    })->name('frontend.about');

    Route::get('/faq', function () {
        return Inertia::render('Frontend/Faq', [
            'translations' => __('frontend'),
            'locale' => session('localization', config('app.locale')),
            'locales' => config('localization.locales'),
        ]);
    })->name('frontend.faq');

    Route::get('/instructions', function () {
        return Inertia::render('Frontend/Instructions', [
            'translations' => __('frontend'),
            'locale' => session('localization', config('app.locale')),
            'locales' => config('localization.locales'),
        ]);
    })->name('frontend.instructions');

    Route::get('/contact', function () {
        return Inertia::render('Frontend/Contact', [
            'translations' => __('frontend'),
            'locale' => session('localization', config('app.locale')),
            'locales' => config('localization.locales'),
        ]);
    })->name('frontend.contact');


    // Mail Controllers
    Route::prefix('/mails')->controller(MailController::class)->name('mails.')->group(function () {
        Route::post('/contact', 'sendMail')->name('frontend.contact.post');
        // Route::get('/', 'index')->name('index');
        // Route::post('/send', 'sendMail')->name('send');

        // Route::get('/selected', 'selectedMail')->name('selectedMail');
        // Route::post('/sendSelected', 'sendSelectedMail')->name('sendSelectedMail');
        // Route::get('/send-mail/{type?}', 'sendMailForm')->where(['type' => '^(facebook|twitter)$'])->name('send');
    });

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


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


    require __DIR__.'/auth.php';

});