<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);

        Blade::if('admin', function () {
            if (auth()->check() && auth()->user()->hasPermission('access-admin-panel')) {
                return true;
            }
            return false;
        });

        Blade::if('member', function () {
            if (auth()->check() && auth()->user()->hasPermission('access-member-area')) {
                return true;
            }
            return false;            
        });

        Blade::if('public', function () {
            return config('filesystems.default') == 'public';
        });

        Blade::if('dropbox', function () {
            return config('filesystems.default') == 'dropbox';
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
