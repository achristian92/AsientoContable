<?php


use App\Http\Controllers\Admin\AccountingPlan\AccountImportController;
use App\Http\Controllers\Admin\AccountingPlan\AccountingPlanController;
use App\Http\Controllers\Admin\AccountingPlan\AccountTemplateController;
use App\Http\Controllers\Admin\AccountingSeat\AccountingSeatController;
use App\Http\Controllers\Admin\Collaborators\AssignCostController;
use App\Http\Controllers\Admin\Collaborators\CollaboratorController;
use App\Http\Controllers\Admin\CostCenter\CenterCost2ImportController;
use App\Http\Controllers\Admin\CostCenter\CenterCostImportController;
use App\Http\Controllers\Admin\CostCenter\CostCenter2Controller;
use App\Http\Controllers\Admin\CostCenter\CostCenterController;
use App\Http\Controllers\Admin\Customers\CustomerController;
use App\Http\Controllers\Admin\Customers\CustomerImportController;
use App\Http\Controllers\Admin\Headers\HeaderController;
use App\Http\Controllers\Admin\MonthCosts\MonthCostController;
use App\Http\Controllers\Admin\Payrolls\PayrollController;
use App\Http\Controllers\Admin\Payrolls\PayrollShowController;
use App\Http\Controllers\Admin\Payrolls\TemplatePayrollController;
use App\Http\Controllers\Admin\PensionsFund\PensionFundController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Front\Costs\CostController;
use App\Http\Controllers\Front\Employees\EmployeeController;
use App\Http\Controllers\Front\Payrolls\PayrollImportController;
use App\Http\Controllers\Front\Seating\GenerateSeatingController;
use App\Http\Controllers\Front\Users\UserController as ApiUserController;
use App\Http\Controllers\Front\PlanAccount\PlanAccountController;
use App\Http\Controllers\Front\AssignCosts\AssignCostController as ApiAssignCostController;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.customers.index');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.' ], function () {
    Route::resource('customers', CustomerController::class);
    Route::post('customers-import', CustomerImportController::class)->name('customers.import');
    Route::resource('users', UserController::class)->except('store','update');
    Route::get('template-account',AccountTemplateController::class)->name('template.account');

    Route::group(['prefix'=>'customer/{customer_id}','as'=>'customers.'],function () {
        Route::get('test',\App\Http\Controllers\TestController::class);
        Route::resource('collaborators', CollaboratorController::class);
        Route::resource('payrolls', PayrollController::class);
        Route::get('payrolls/{file}/detail/{payroll}', PayrollShowController::class)->name('payroll.detail');
        Route::post('payroll-import', PayrollImportController::class)->name('payroll-import');
        Route::resource('month-costs', MonthCostController::class);
        Route::resource('assign-costs', AssignCostController::class);
        Route::resource('accounting-seat', AccountingSeatController::class);
        Route::get('accounting-seat/{file}/export', [AccountingSeatController::class,'export'])->name('seating.export');
        Route::resource('cost-center', CostCenterController::class);
        Route::resource('cost-center2', CostCenter2Controller::class);
        Route::post('cost-center-import', CenterCostImportController::class)->name('center-cost.import');
        Route::post('cost-center-import2', CenterCost2ImportController::class)->name('center-cost2.import');
        Route::resource('accounting-plan', AccountingPlanController::class);
        Route::post('account-import', AccountImportController::class)->name('account.import');
        Route::resource('headers', HeaderController::class);
        Route::resource('pensions', PensionFundController::class);
        Route::get('template-payroll', TemplatePayrollController::class)->name('template-payroll');
    });
});

Route::group(['prefix' => 'api', 'middleware' => ['auth']], function () {
    Route::resource('users', ApiUserController::class)->only('store','update');

    Route::group(['prefix'=>'customer/{customer_id}','as'=>'api.customers.'],function () {
        Route::get('employees', EmployeeController::class);
        Route::get('costs', CostController::class);
        Route::resource('assign-cost', ApiAssignCostController::class)->only('store','show','destroy');
        Route::resource('plan-account', PlanAccountController::class);
        Route::post('generate-seating', GenerateSeatingController::class);
    });
});


require __DIR__.'/auth.php';
