<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata;
use Illuminate\Http\RedirectResponse;

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
        $all_biodatas = Biodata::all();
        $all_biodatas_array = [
            'all_biodatas' => $all_biodatas,
        ];
        $pageProps = $all_biodatas_array + $this->pageProps;
        return Inertia::render('Admin/Home', $pageProps);
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
                if( Auth::guard('translations')->attempt( ['email' => $request->input('email'),  'password' => $request->input('password')] ) ){
                    $request->session()->regenerate();
                    return redirect()->route('backend.dashboard')->with('success','You are Logged in sucessfully.');
                }
            }
        }

        return back()->with('error','Whoops! invalid email and password.');

    }


    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        Auth::guard('translations')->logout();

        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('backend.login'));
    }


    public function backEndFallBack(Request $request)
    {
        return Inertia::render('Admin/404', $this->pageProps);
    }


}
