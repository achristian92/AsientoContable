<?php


namespace App\Providers;


use App\AsientoContable\CenterCosts\Repositories\CenterCostRepo;
use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use App\AsientoContable\AccountPlan\Repositories\AccountPlanRepo;
use App\AsientoContable\AccountPlan\Repositories\IAccountPlan;
use App\AsientoContable\Collaborators\Repositories\CollaboratorRepo;
use App\AsientoContable\Collaborators\Repositories\ICollaborator;
use App\AsientoContable\CostsCenter2\Repositories\CenterCost2Repo;
use App\AsientoContable\CostsCenter2\Repositories\ICenterCost2;
use App\AsientoContable\Customers\Repositories\CustomerRepo;
use App\AsientoContable\Customers\Repositories\ICustomer;
use App\AsientoContable\Payrolls\Repositories\IPayroll;
use App\AsientoContable\Payrolls\Repositories\PayrollRepo;
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
            IPayroll::class,
            PayrollRepo::class
        );

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
            ICenterCost2::class,
            CenterCost2Repo::class
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
