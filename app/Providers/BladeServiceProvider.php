<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('role', function (string $roleName){
            return "<?php if (auth()->check() && auth()->user()->hasRole($roleName)): ?>";
        });

        Blade::directive('endRole', function() {
            return "<?php endif; ?>";
        });
    }
}
