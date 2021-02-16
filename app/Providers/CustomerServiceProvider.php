<?php

namespace App\Providers;

use App\AsientoContable\Customers\Customer;
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
        if (customerID() != 0) {
            View::share('currentCustomer', Customer::find(customerID()));
        }
    }
}
