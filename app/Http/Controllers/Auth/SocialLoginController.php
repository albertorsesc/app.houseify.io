<?php

namespace App\Http\Controllers\Auth;

use App\Models\SocialAccount;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialLoginController extends Controller
{
    public function redirectToProvider($driver) : RedirectResponse
    {
        if (! in_array($driver, config('services.login_services'))) {
            return redirect('login')
                ->with('error', 'Lo sentimos, la Plataforma ' . $driver . ' aún no está soportada para el inicio de sesión en Houseify.io');
        }

        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback(Request $request, $driver)
    {
        if ($request->get('error')) {
            return redirect('login');
        }

        try {
            $socialUser = Socialite::driver($driver)->user();
            $fullName = explode(' ', $socialUser->getName());

            $socialAccount = SocialAccount::where('client_id', $socialUser->getId())
                                          ->where('name', $driver)
                                          ->first();

            if (! $socialAccount) {
                $user = User::query()->where('email', $socialUser->getEmail())->first();

                if (! $user) {
                    $user = User::create([
                        'first_name' => $fullName[0],
                        'last_name' => $fullName[1] ?? '-',
                        'email' => $socialUser->getEmail(),
                        'email_verified_at' => now()->toDateTimeString(),
                        'profile_photo_path' => $socialUser->getAvatar()
                    ]);
                }

                $socialAccount = $user->socialAccounts()->create([
                    'name' => $driver,
                    'client_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            }

            auth()->login($socialAccount->user, true);

            return redirect('inicio');

        } catch (\Exception $exception) {
            return redirect('login')->with('error', 'Algo sucedió, también puedes registrarte para iniciar sesión.');
        }
    }

    public function destroy($driver)
    {
        if (! $auth = auth()->user()) {
            return redirect('login');
        }

        $auth->socialAccounts()->where('name', $driver)->delete();

        if (! $auth->password) {
            $redirectTo = 'forgot-password';
            $message = 'Tu cuenta de ' . ucwords($driver) . ' ha sido desvinculada. Por favor, cree una contraseña para iniciar sesión.';
        } else {
            $redirectTo = 'inicio';
            $message = 'Tu cuenta de ' . ucwords($driver) . ' ha sido desvinculada.';
        }

        return redirect($redirectTo)->with('message', $message);
    }
}
