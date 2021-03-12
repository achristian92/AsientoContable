<?php


namespace App\Http\Controllers\Admin\Payrolls;



use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Payrolls\Transformations\PayrollTransformable;
use App\Http\Controllers\Controller;

class PayrollShowController extends Controller
{
    use PayrollTransformable;

    private $conceptRepo;

    public function __construct(IConcept $IConcept)
    {
        $this->conceptRepo = $IConcept;
    }

    public function __invoke($customer_id,$file_id,$collaborator_id)
    {

        return view('customers.collaborators.monthly-payroll.detail',[
            'detail' => $this->conceptRepo->detailConceptCollaborator($file_id,$collaborator_id)
        ]);
    }




}
