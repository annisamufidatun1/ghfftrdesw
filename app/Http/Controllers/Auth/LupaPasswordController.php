<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class LupaPasswordController extends Controller
{
    public function changePassword()
    {
    return view('auth.reset-password');
    }

    public function updatePassword(Request $request) {
        # Validation
        $request->validate([
            'email' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->email)){
            return back()->with("error", "The Email doesnt match with our credentials");
        }
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
        return redirect ('/');
    }
}
