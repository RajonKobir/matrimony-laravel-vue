<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthenticatedSessionController extends Controller
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
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ];
    }

    /**
     * Display the login view.
     */
    public function create(): Response
    {
        if (Auth::guard('web')->user()) {
            return redirect()->intended(route('user.profile', absolute: false));
        }
        return Inertia::render('Auth/Login', $this->pageProps);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    // public function store(Request $request): RedirectResponse
    {
        //authenticating
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('user.profile', absolute: true));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
