<?php


namespace App\Providers;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class GlobalTemplateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer([
            '*',
        ], function ($view)
        {
            $view->with([
                'userCurrent' => Auth::user()
            ]);
        });

    }

}
