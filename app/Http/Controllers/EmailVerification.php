<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerification extends Controller
{
    
    public function showVerificationPage()
    {
        $user = Auth::user();
        if($user->hasVerifiedEmail())
        {
            return redirect("/dashboard")->with('status', "Email successfully verified");
        }
        else
        {
            return view('auth.verify');
        }
    }

    public function EmailVerification(EmailVerificationRequest $request) 
    {
        $request->fulfill();
        return redirect('/dashboard');
    }    
}
