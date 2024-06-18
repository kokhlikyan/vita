<?php

namespace App\Services;

use App\Events\VerifyMailEvent;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Random\RandomException;

class AuthService
{
    /**
     * @throws RandomException
     */
    public function sendCode(string $email): bool
    {
//        $code = random_int(1000, 9999);
        $code = 1234;
        VerificationCode::query()->updateOrCreate([
            'email' => $email,
        ], [
            'code' => $code,
            'expires_at' => now()->addMinutes(5),
        ]);
        event(new VerifyMailEvent($code, $email));
        return true;
    }

    public function verifyCode(string $email, string $code): Builder|Model|null
    {
        $verification = VerificationCode::query()
            ->where('email', $email)
            ->where('code', $code)
            ->first();
        if ($verification) {
            $verification->delete();
            return User::query()->updateOrCreate([
                'email' => $email,
            ], [
                'email_verified_at' => now(),
            ]);
        }

        return null;
    }

    public function updateInfo(string $first_name, string $last_name)
    {
        $user = 111;
        dd(auth()->user());
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->save();
        return $user;
    }
}
