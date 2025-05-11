<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Biodata;

class SettingsController extends Controller
{

    private $pageProps;

    public function __construct(){
        //initializing
        $this->pageProps = [
            'status' => session('status'),
            'translations' => __('frontend'),
            'locale' => session('localization', config('app.locale')),
            'locales' => config('localization.locales'),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'single_biodata' => [],
        ];

        if (Auth::guard('web')->user()) {
            $user_id = Auth::guard('web')->user()->id;
            $single_biodata = Biodata::where('user_id', $user_id)->get();
            if( $single_biodata ){
                if( count( $single_biodata ) == 1 ){
                    $this->pageProps['single_biodata'] = $single_biodata[0];
                }
            }
        }

    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $mustVerifyEmail = [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
        ];
        $pageProps = $mustVerifyEmail + $this->pageProps;
        // return $pageProps;
        return Inertia::render('Settings/Edit', $pageProps);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $is_user_saved = $request->user()->save();

        if( $is_user_saved ){
            if (Auth::guard('web')->user()) {
                $user_id = Auth::guard('web')->user()->id;
                $biodata = Biodata::where('user_id', $user_id)->get();
                if( count($biodata) == 1 ){
                    $biodata = Biodata::where('user_id', $user_id)->update([
                        'user_mobile' => $request->mobile,
                        'user_email' => $request->email,
                    ]);
                }
            }
        }

        // return Redirect::route('user.settings.edit', $this->pageProps);
        return redirect()->back()->with('success');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
}
