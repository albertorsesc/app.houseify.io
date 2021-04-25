<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleLoginController extends Controller
{
    public function redirectToProvider() : RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['provider_id' => $googleUser->getId()],
            [
                'email' => $googleUser->getEmail(),
                'first_name' => $googleUser->getName(),
                'last_name' => 'G',
                'email_verified_at' => now()->toDateTimeString(),
            ]
        );

        auth()->login($user, true);

        return redirect('inicio');
    }
}
