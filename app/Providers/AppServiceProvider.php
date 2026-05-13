<?php

namespace App\Providers;

use Filament\Auth\Http\Responses\Contracts\LoginResponse as FilamentLoginResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FilamentLoginResponse::class, function () {
            return new class implements FilamentLoginResponse {
                public function toResponse($request)
                {
                    return redirect('/admin');
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
