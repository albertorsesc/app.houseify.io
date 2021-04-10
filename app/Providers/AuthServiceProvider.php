<?php

namespace App\Providers;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\URL;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Properties\Property::class => \App\Policies\PropertyPolicy::class,
        \App\Models\Businesses\Business::class => \App\Policies\BusinessPolicy::class,
        \App\Models\JobProfiles\JobProfile::class => \App\Policies\JobProfilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->isRoot()) {
                return true;
            }
        });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $url = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                ['id' => $notifiable->id, 'hash' => sha1($notifiable->email)]
            );
            return (new MailMessage)
                ->subject('[Houseify.io] Correo Electrónico de verificacion')
                ->greeting('Bienvenido a Houseify.io!')
                ->line('Agradecemos te hayas unido a esta comunidad creada especialmente para todos los que estamos relacionado al ramo de la construccion!')
                ->line('Este correo es para verificar tu identidad, por favor haz click en el enlace para accesar a tu cuenta!')
                ->action('Verficar mi correo electronico', $url)
                ->line('Gracias por apoyarnos!');
        });
    }
}
