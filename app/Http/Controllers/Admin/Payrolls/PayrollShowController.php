<?php


namespace App\Http\Controllers\Admin\Payrolls;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Payrolls\Payroll;
use App\AsientoContable\Payrolls\Transformations\PayrollTransformable;
use App\Http\Controllers\Controller;

class PayrollShowController extends Controller
{
    use PayrollTransformable;

    public function __invoke($customer_id,$file_id,$payroll_id)
    {
        $account = AccountPlan::whereCustomerId($customer_id)->get()->whereNotIn('import_slug','');

        return view('customers.collaborators.monthly-payroll.detail',[
            'payroll' => $this->transformPaybleDetail(Payroll::find($payroll_id),$account)
        ]);

    }

}
