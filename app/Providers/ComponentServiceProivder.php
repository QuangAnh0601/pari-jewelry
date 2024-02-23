<?php

namespace App\Providers;

use App\Http\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProivder extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CategoryRepository::class, function ($app) {
            return new CategoryRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
