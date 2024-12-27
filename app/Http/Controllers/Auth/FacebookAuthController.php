<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookAuthController extends Controller
{
    //facebook auth
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        try {

            $facebook_user = Socialite::driver('facebook')->user();

            $user = User::where( 'facebook_id', $facebook_user->getId() )->first();

            dd($facebook_user);

            if (!$user) {

                $new_user = User::create([
                    'name' => strval($facebook_user->getName()),
                    'email' => strval($facebook_user->getEmail()),
                    'facebook_id' =>  strval($facebook_user->getId())
                ]);

                Auth::login($new_user);

            }else{

                Auth::login($user);

            }

            return redirect()->intended(route('user.profile', absolute: false));

        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
