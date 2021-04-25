<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FacebookLoginController extends Controller
{
    public function redirectToProvider() : RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        $user = User::firstOrCreate(
            ['provider_id' => $facebookUser->getId()],
            [
                'email' => $facebookUser->getEmail(),
                'first_name' => $facebookUser->getName(),
                'last_name' => 'FB',
                'email_verified_at' => now()->toDateTimeString(),
            ]
        );

        auth()->login($user, true);

        return redirect('inicio');
    }
}
