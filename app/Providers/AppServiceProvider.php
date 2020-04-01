<?php

namespace App\Providers;

use App\Models\Betreuung;
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

            $channels =  Channel::all();

            $view->with('channels', $channels);
        });

        view()->composer('courses.index', function ($view) {

            $klasses =  Betreuung::orderBy('courses_count', 'desc')->get();

            $view->with('klasses', $klasses);
        });

        Validator::extend('spamFree', 'App\Rules\SpamFree@passes');
    }
}
