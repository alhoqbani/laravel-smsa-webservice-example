<?php

namespace App\Providers;

use Alhoqbani\SmsaWebService\Smsa;
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
        $this->app->bind(Smsa::class, function () {

            $passKey = config('services.smsa.key');

            $smsa = new Smsa($passKey);

            return $smsa;
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
