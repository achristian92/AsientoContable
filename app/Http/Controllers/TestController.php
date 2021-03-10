<?php


namespace App\Http\Controllers;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Payrolls\Payroll;
use App\AsientoContable\Payrolls\Transformations\PayrollTransformable;
use App\AsientoContable\PensionFund\PensionFund;
use App\AsientoContable\Tools\NestedsetTrait;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Str;

class TestController extends Controller
{
    use NestedsetTrait, PayrollTransformable;

    private $companyRepo;
    private $terms;
    private $userRepo;

    public function __construct()
    {


    }

    public function __invoke()
    {
        $account = AccountPlan::whereCustomerId(1)->get()->whereNotIn('import_slug','');
        $data = Payroll::find(4);
        $trans = $this->transformPaybleDetail($data,$account);
        $pluck = $trans->concepts->where('type','GASTO')->pluck('raw_amount')->sum();
        $pluck2 = $trans->concepts->where('type','PASIVO')->pluck('raw_amount')->sum();
        dd($trans,$pluck,$pluck2);

    }




}
