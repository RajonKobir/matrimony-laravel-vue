<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Models\District;


class FrontEndController extends Controller
{

    private $pageProps;

    public function __construct(){
        //initializing
        $this->pageProps = [
            'translations' => __('frontend'),
            'locale' => session('localization', config('app.locale')),
            'locales' => config('localization.locales'),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ];
    }

    public function homePage(){
        return Inertia::render('Welcome', $this->pageProps);
    }

    public function aboutPage(){
        return Inertia::render('Frontend/About', $this->pageProps);
    }

    public function faqPage(){
        return Inertia::render('Frontend/Faq', $this->pageProps);
    }

    public function instructionsPage(){
        return Inertia::render('Frontend/Instructions', $this->pageProps);
    }

    public function contactPage(){
        return Inertia::render('Frontend/Contact', $this->pageProps);
    }

    public function userDashboard(){

        $districts = District::all();
        $districts_array = [
            'districts' => $districts,
        ];
        $pageProps = $districts_array + $this->pageProps;

        return Inertia::render('Dashboard', $pageProps);
    }

}
