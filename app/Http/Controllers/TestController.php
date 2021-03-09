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

        $collaborator = Payroll::with('costs')->find(2);



        DD($collaborator);

    }


}
