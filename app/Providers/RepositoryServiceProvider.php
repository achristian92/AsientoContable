<?php


namespace App\Providers;


use App\Voucher\Customers\Repositories\CustomerRepo;
use App\Voucher\Customers\Repositories\ICustomer;
use App\Voucher\Users\Repositories\IUser;
use App\Voucher\Users\Repositories\UserRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {

        $this->app->bind(
            ICustomer::class,
            CustomerRepo::class
        );

        $this->app->bind(
            IUser::class,
            UserRepo::class
        );
    }

}
