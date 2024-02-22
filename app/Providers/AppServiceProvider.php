<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 20220519 :: UNCOMMENT FOLLOWING LINE IF WE DO NOT WANT TO USE MIGRATION FOR sanctum (personal_access_token)
        //Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * 20220519 :: UNCOMMENT IT IF WE ARE USING LATEST MYSQL
         * MIGRATION IS FAILING DUE TO USE OLD MYSQL SERVER
         * THE CODE BELOW IS TEMPORARY FIX AND MAY CAUSE table INDEXING ISSUE
         * ALSO CAN EFFECT TO STORE EMOJI IN THE DATABASE
         */
        
        if (env('REDIRECT_HTTPS') == true) {
           // $url->forceScheme('https');
            \URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);
    }
}
