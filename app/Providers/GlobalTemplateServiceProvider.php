<?php


namespace App\Providers;



use App\AsientoContable\Customers\Customer;
use App\Sidpro\Projects\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
