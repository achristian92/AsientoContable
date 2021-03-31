<?php


namespace App\Http\Controllers\Admin\Payrolls;



use App\AsientoContable\Concepts\Repositories\IConcept;
use App\Http\Controllers\Controller;

class PayrollShowController extends Controller
{

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
