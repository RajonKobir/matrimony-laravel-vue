<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Validation\Rules;

class AdminAuthController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
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
                return redirect()->route('adminDashboard')->with('success','You are Logged in sucessfully.');
                // return Inertia::render('Admin/Home');
            }
        }

        return back()->with('error','Whoops! invalid email and password.');

    }

    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logged out sucessfully');
        return redirect(route('adminLogin'));
    }
}
