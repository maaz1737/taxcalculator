<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{



    public function redirect()
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if (! $user) {
            $user = User::create([
                'name'              => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Google User',
                'email'             => $googleUser->getEmail(),
                'password'          => bcrypt(Str::random(32)),
                'email_verified_at' => now(),

            ]);
        }
        // else {
        //     $user->update([
        //         'google_id'     => $user->google_id ?: $googleUser->getId(),
        //         'google_avatar' => $googleUser->getAvatar(),
        //     ]);
        // }

        Auth::login($user, remember: false);

        return redirect()->route('home');
    }
}
