<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\NasaPicture;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(NasaPicture::class, function(){
            return new NasaPicture(config('services.nasa.key'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
