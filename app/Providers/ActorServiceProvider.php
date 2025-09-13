<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActorService;

class ActorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ActorService::class, function ($app) {
            return new ActorService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
