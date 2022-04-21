<?php

namespace App\Providers;

use App\AsientoContable\Customers\Customer;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            '*',
        ], function ($view)
        {
            $view->with([
                'userCurrent' => Auth::user(),
            ]);
        });

        if (customerID()) {
            View::share('currentCustomer', Customer::find(customerID()));
        }
    }
}
