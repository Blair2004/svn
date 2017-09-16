<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        config([ 'app.errors' => [
            'registration-disabled'     =>  [
                'title'     =>  __( 'Registration is disabled' ),
                'message'   =>  __( 'Unable to register. The registration is disabled.' )
            ]
        ]]);

        Validator::extend('version_number', function ($attribute, $value, $parameters, $validator) {
            return version_compare( $value, '0.0.1', '>=' );
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
