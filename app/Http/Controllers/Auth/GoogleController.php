<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();

    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        dd($user);
    }
}
