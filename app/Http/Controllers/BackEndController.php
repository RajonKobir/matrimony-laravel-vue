<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class BackEndController extends Controller
{


    private $pageProps;

    public function __construct(){
        //initializing
        $this->pageProps = [
            'translations' => __('backend'),
            'locale' => session('localization', config('app.locale')),
            'locales' => config('localization.locales'),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ];
    }

    public function getDashboard(){
        return Inertia::render('Admin/Home', $this->pageProps);
    }

    public function getLogin(){
        if (Auth::guard('admin')->user()) {
            return redirect()->route('backend.dashboard')->with('success','You are already Logged in.');
        }
        return Inertia::render('Admin/Login', $this->pageProps);
    }

    public function postLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email|max:100',
            'password' => ['required', 'string', Rules\Password::defaults()->min(6)->max(20)],
        ]);

        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            $user = auth()->guard('admin')->user();
            if($user){
                $request->session()->regenerate();
                return redirect()->route('backend.dashboard')->with('success','You are Logged in sucessfully.');
            }
        }

        return back()->with('error','Whoops! invalid email and password.');

    }


    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('backend.login'));
    }


    public function backEndFallBack(Request $request)
    {
        return Inertia::render('Admin/404', $this->pageProps);
    }


}
