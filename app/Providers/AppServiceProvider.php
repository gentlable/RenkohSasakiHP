<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
        // 効いてるかわからんからコメントアウト
        // Schema::defaultStringLength(191);

        // // change route to app_url
        // if (config('my.force_app_url') == true) {
        //     URL::forceRootUrl(config('app.url'));
        //     if (parse_url(config('app.url'), PHP_URL_SCHEME) === "http") {
        //         URL::forceScheme('https');
        //     }
        // }
    }
}
