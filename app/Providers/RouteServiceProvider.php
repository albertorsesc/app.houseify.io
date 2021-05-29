<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/inicio';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware(['web', 'prevent-back-history'])
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            /* Sections */
            $this->mapPropertiesApiRoutes();
            $this->mapPropertiesWebRoutes();
            $this->mapBusinessesApiRoutes();
            $this->mapBusinessesWebRoutes();
            $this->mapJobProfilesApiRoutes();
            $this->mapJobProfilesWebRoutes();
            /* Forum */
            $this->mapThreadsApiRoutes();
            $this->mapThreadsWebRoutes();
            $this->mapForumWebRoutes();

        });
    }

    /* Sections */

    public function mapPropertiesApiRoutes ()
    {
        Route::middleware(['api', 'auth:sanctum'])
             ->name('api.')
             ->prefix('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/properties/api.php'));
    }

    public function mapPropertiesWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/properties/web.php'));
    }

    public function mapBusinessesApiRoutes ()
    {
        Route::middleware(['api', 'auth:sanctum'])
             ->name('api.')
             ->prefix('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/businesses/api.php'));
    }

    public function mapBusinessesWebRoutes()
    {
        Route::middleware(['web'])
             ->namespace($this->namespace)
             ->group(base_path('routes/businesses/web.php'));
    }

    public function mapJobProfilesApiRoutes ()
    {
        Route::middleware(['api', 'auth:sanctum'])
             ->name('api.')
             ->prefix('api')
            ->namespace($this->namespace)
             ->group(base_path('routes/job-profiles/api.php'));
    }

    public function mapJobProfilesWebRoutes()
    {
        Route::middleware(['web'])
             ->namespace($this->namespace)
             ->group(base_path('routes/job-profiles/web.php'));
    }

    /* Modules */

    public function mapThreadsApiRoutes ()
    {
        Route::middleware(['api'])
             ->name('api.')
             ->prefix('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/forum/threads/api.php'));
    }

    public function mapThreadsWebRoutes()
    {
        Route::middleware(['web'])
             ->namespace($this->namespace)
             ->group(base_path('routes/forum/threads/web.php'));
    }

    public function mapForumWebRoutes()
    {
        Route::middleware(['web'])
             ->namespace($this->namespace)
             ->group(base_path('routes/forum/web.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
