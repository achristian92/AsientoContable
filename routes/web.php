<?php


use App\Http\Controllers\Admin\AccountingPlan\AccountingPlanController;
use App\Http\Controllers\Admin\AccountingSeat\AccountingSeatController;
use App\Http\Controllers\Admin\Collaborators\CollaboratorController;
use App\Http\Controllers\Admin\CostCenter\CostCenterController;
use App\Http\Controllers\Admin\Customers\CustomerController;
use App\Http\Controllers\Admin\MonthlyPayroll\MonthlyPayrollController;
use App\Http\Controllers\Admin\Users\UserController;

Route::get('/', function () {
    return redirect('login');
});

Route::get('test',\App\Http\Controllers\TestController::class);

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.' ], function () {

    Route::resource('customers', CustomerController::class);
    Route::resource('users', UserController::class);

    Route::group(['prefix'=>'customer/{customer_id}','as'=>'customers.'],function () {
        Route::resource('collaborators', CollaboratorController::class);
        Route::resource('monthly-payroll', MonthlyPayrollController::class);
        Route::resource('accounting-seat', AccountingSeatController::class);
        Route::resource('cost-center', CostCenterController::class);
        Route::resource('accounting-plan', AccountingPlanController::class);
    });



});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
