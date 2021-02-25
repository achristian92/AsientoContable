<?php


use App\Http\Controllers\Admin\AccountingPlan\AccountImportController;
use App\Http\Controllers\Admin\AccountingPlan\AccountingPlanController;
use App\Http\Controllers\Admin\AccountingSeat\AccountingSeatController;
use App\Http\Controllers\Admin\Collaborators\CollaboratorController;
use App\Http\Controllers\Admin\CostCenter\CenterCost2ImportController;
use App\Http\Controllers\Admin\CostCenter\CenterCostImportController;
use App\Http\Controllers\Admin\CostCenter\CostCenter2Controller;
use App\Http\Controllers\Admin\CostCenter\CostCenterController;
use App\Http\Controllers\Admin\Customers\CustomerController;
use App\Http\Controllers\Admin\Customers\CustomerImportController;
use App\Http\Controllers\Admin\MonthlyPayroll\MonthlyPayrollController;
use App\Http\Controllers\Admin\PensionsFund\PensionFundController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Front\PlanAccount\PlanAccountController;

Route::get('/', function () {
    return redirect('login');
});

Route::get('test',\App\Http\Controllers\TestController::class);

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.' ], function () {
    Route::resource('customers', CustomerController::class);
    Route::post('customers-import', CustomerImportController::class)->name('customers.import');
    Route::resource('users', UserController::class);
    Route::resource('pensions', PensionFundController::class);

    Route::group(['prefix'=>'customer/{customer_id}','as'=>'customers.'],function () {
        Route::resource('collaborators', CollaboratorController::class);
        Route::resource('monthly-payroll', MonthlyPayrollController::class);
        Route::resource('accounting-seat', AccountingSeatController::class);
        Route::resource('cost-center', CostCenterController::class);
        Route::resource('cost-center2', CostCenter2Controller::class);
        Route::post('cost-center-import', CenterCostImportController::class)->name('center-cost.import');
        Route::post('cost-center-import2', CenterCost2ImportController::class)->name('center-cost2.import');
        Route::resource('accounting-plan', AccountingPlanController::class);
        Route::post('account-import', AccountImportController::class)->name('account.import');
    });
});

Route::group(['prefix' => 'api', 'middleware' => ['auth']], function () {
    Route::group(['prefix'=>'customer/{customer_id}','as'=>'api.customers.'],function () {
        //Route::get('plan-account-main', PlanAccountController::class);
        Route::resource('plan-account', PlanAccountController::class);
    });
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
