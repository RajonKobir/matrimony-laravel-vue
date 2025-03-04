<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Biodata;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register', [
            'translations' => __('frontend'),
            'locale' => session('localization', config('app.locale')),
            'locales' => config('localization.locales'),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'mobile' => $request->email ? 'nullable|string|min:11|max:11|regex:/(01)[0-9]{9}/|unique:'.User::class : 'required|string|min:11|max:11|regex:/(01)[0-9]{9}/|unique:'.User::class,
            'email' => $request->mobile ? 'nullable|string|lowercase|email:rfc,dns|max:100|unique:'.User::class : 'required|string|lowercase|email:rfc,dns|max:100|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()->min(6)->max(20)],
        ]);

        $user = User::create([
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if( $user ){
            $biodata = new Biodata();
            $biodata->user_id = $user->id;
            $biodata->biodata_code = mt_rand(100000,999999) . '-' . uniqid();
            $biodata->user_mobile = $request->mobile;
            $biodata->user_email = $request->email;
            $biodata->save();

            if( $biodata ){
                event(new Registered($user));
                Auth::login($user);
            }

        }

        return redirect(route('user.profile', absolute: false));
    }
}
