<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\ITask::class,
            \App\Repositories\TaskRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Passport::tokensExpireIn(CarbonInterval::minute(1));
        // Passport::refreshTokensExpireIn(CarbonInterval::minute(2));
        Passport::enablePasswordGrant();
    }
}
