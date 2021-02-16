<?php


namespace App\Providers;


use App\AsientoContable\AccountPlan\CenterCosts\Repositories\CenterCostRepo;
use App\AsientoContable\AccountPlan\CenterCosts\Repositories\ICenterCost;
use App\AsientoContable\AccountPlan\Repositories\AccountPlanRepo;
use App\AsientoContable\AccountPlan\Repositories\IAccountPlan;
use App\AsientoContable\Collaborators\Repositories\CollaboratorRepo;
use App\AsientoContable\Collaborators\Repositories\ICollaborator;
use App\AsientoContable\Customers\Repositories\CustomerRepo;
use App\AsientoContable\Customers\Repositories\ICustomer;
use App\AsientoContable\PensionFund\Repositories\IPensionFund;
use App\AsientoContable\PensionFund\Repositories\PensionFundRepo;
use App\AsientoContable\Users\Repositories\IUser;
use App\AsientoContable\Users\Repositories\UserRepo;
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

        $this->app->bind(
            IAccountPlan::class,
            AccountPlanRepo::class
        );

        $this->app->bind(
            ICenterCost::class,
            CenterCostRepo::class
        );

        $this->app->bind(
            ICollaborator::class,
            CollaboratorRepo::class
        );

        $this->app->bind(
            IPensionFund::class,
            PensionFundRepo::class
        );
    }

}
