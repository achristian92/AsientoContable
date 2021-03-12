<?php


namespace App\Http\Controllers;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Files\File;
use App\AsientoContable\Payrolls\Payroll;
use App\AsientoContable\Payrolls\Transformations\PayrollTransformable;
use App\AsientoContable\PensionFund\PensionFund;
use App\AsientoContable\Tools\NestedsetTrait;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Str;

class TestController extends Controller
{
    use NestedsetTrait, PayrollTransformable;

    private $companyRepo;
    private $terms;
    private $userRepo;
    private $conceptRepo;

    public function __construct(IConcept $IConcept)
    {
        $this->conceptRepo = $IConcept;
    }

    public function __invoke()
    {
    }


}
