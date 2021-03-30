<?php


namespace App\Providers;


use App\AsientoContable\CenterCosts\Repositories\CenterCostRepo;
use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use App\AsientoContable\AccountPlan\Repositories\AccountPlanRepo;
use App\AsientoContable\AccountPlan\Repositories\IAccountPlan;
use App\AsientoContable\Collaborators\Repositories\CollaboratorRepo;
use App\AsientoContable\Collaborators\Repositories\ICollaborator;
use App\AsientoContable\Concepts\Repositories\ConceptRepo;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\CostsCenter2\Repositories\CenterCost2Repo;
use App\AsientoContable\CostsCenter2\Repositories\ICenterCost2;
use App\AsientoContable\Customers\Repositories\CustomerRepo;
use App\AsientoContable\Customers\Repositories\ICustomer;
use App\AsientoContable\Employees\CostEmployees\Repositories\CostEmployeeRepo;
use App\AsientoContable\Employees\CostEmployees\Repositories\ICostEmployee;
use App\AsientoContable\Employees\MonthCosts\Repositories\IMonthCost;
use App\AsientoContable\Employees\MonthCosts\Repositories\MonthCostRepo;
use App\AsientoContable\Files\Repositories\FileRepo;
use App\AsientoContable\Files\Repositories\IFile;
use App\AsientoContable\Headers\Repositories\HeaderRepo;
use App\AsientoContable\Headers\Repositories\IHeader;
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
            IHeader::class,
            HeaderRepo::class
        );
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

        $this->app->bind(
            IFile::class,
            FileRepo::class
        );

        $this->app->bind(
            IConcept::class,
            ConceptRepo::class
        );

        $this->app->bind(
            IMonthCost::class,
            MonthCostRepo::class
        );

        $this->app->bind(
            ICostEmployee::class,
            CostEmployeeRepo::class
        );
    }

}
