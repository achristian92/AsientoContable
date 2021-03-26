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
        $headerImport=  collect([
            "codigo", "trabajador", "centro_costo", "centro_costo2", "cod_area", "area", "cod_cargo",
            "cargo", "fecha_ingreso", "fecha_cese", "nro_identidad", "pension", "moneda", "basico", "dias_trab", "horas_trab",
            "horas_extra", "min_extra", "dias_pdt", "base_imponible", "remuneracion_basica", "asignacion_familiar", "total_ingresos", "afp_aportacion",
            "onp", "afp_seguro", "afp_ra", "5ta_categoria", "eps", "total_egresos", "essalud", "total_aportes", "neto", "condicion_trabajo"
        ]);

        $headerCustomer = AccountHeader::where(['customer_id'=>1,'show'=>true])->pluck('name_slug');
        $diff = $headerImport->diff($headerCustomer);

        dd($diff->all(),$headerImport->count(),$headerCustomer->count());
    }


}
