<?php

namespace App\Providers;

use App\Models\Channel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {

            $channels = Cache::rememberForever('channels', function () {
                return Channel::all();
            });

            $view->with('channels', $channels);
        });

        Validator::extend('spamFree', 'App\Rules\SpamFree@passes');
    }
}
