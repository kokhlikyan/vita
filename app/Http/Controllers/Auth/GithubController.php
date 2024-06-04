<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirectToGithub()
    {

        return Socialite::driver('github')->stateless()->redirect();
    }

    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();
        dd($user);
    }
}
