<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\NewSocialMediaUserRegistration;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
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
        try {
            $googleUser = Socialite::driver('google')->user();
            $fullName = explode(' ', $googleUser->getName());

            $user = User::where('provider_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->firstOrCreate([
                            'provider_id' => $googleUser->getId()
                        ],
                        [
                            'first_name' => $fullName[0],
                            'last_name' => $fullName[1] ?? '-',
                            'provider_id' => $googleUser->getId(),
                            'email' => $googleUser->getEmail(),
                            'email_verified_at' => now()->toDateTimeString(),
                        ]);

            auth()->login($user, true);

            return redirect('inicio');
        } catch (\Exception $exception) {
            Log::error('Google Login: ', json_decode($exception));

            redirect()->back()->with('error', 'Algo sucedió, también puedes registrarte para iniciar sesión.');
        }
    }
}
