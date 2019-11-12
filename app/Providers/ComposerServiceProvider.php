<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use View;
use Session;
use Illuminate\Support\Facades\Auth;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        View::composer('*', function($view){
               $view->with('user', 
               User::where('id',Auth::id())->first());
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
