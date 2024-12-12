<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    //google auth
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {

            $google_user = Socialite::driver('google')->user();

            $user = User::where( 'google_id', $google_user->getId() )->first();

            // dd($google_user->getId());

            if (!$user) {

                $new_user = User::create([
                    'name' => strval($google_user->getName()),
                    'email' => strval($google_user->getEmail()),
                    'google_id' =>  strval($google_user->getId())
                ]);

                Auth::login($new_user);

            }else{

                Auth::login($user);

            }

            return redirect()->intended(route('user.dashboard', absolute: false));

        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            // return redirect()->intended(route('login', absolute: false));
            // return redirect()->intended(route('login', absolute: false))->with('error', 'An error occured!');
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
