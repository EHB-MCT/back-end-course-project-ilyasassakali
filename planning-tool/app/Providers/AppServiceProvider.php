<?php

namespace App\Providers;

use App\Models\Vak;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $vakken = Vak::all();
        View::share('vakken', $vakken);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }


}
