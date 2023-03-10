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
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/redirects';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web','auth','role:jefe')
                ->prefix('jefe')
                ->group(base_path('routes/jefe.php'));

            Route::middleware('web','auth','role:supervisor')
                ->prefix('supervisor')
                ->group(base_path('routes/supervisor.php'));

            Route::middleware('web','auth','role:asistente')
                ->prefix('asistente')
                ->group(base_path('routes/asistente.php'));

            Route::middleware('web','auth','role:operario')
                ->prefix('operario')
                ->group(base_path('routes/operario.php'));

            Route::middleware('web','auth','role:planificador')
                ->prefix('planificador')
                ->group(base_path('routes/planificador.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
