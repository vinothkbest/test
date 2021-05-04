<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Blade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            $pattern = "/[6-9]{1}[0-9]{9}/";
            return preg_match($pattern, $value);
        });
    }
}
