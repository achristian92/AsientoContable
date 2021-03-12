<?php


namespace App\Http\Controllers\Admin\Payrolls;


use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Files\Repositories\IFile;
use App\AsientoContable\Payrolls\Repositories\IPayroll;
use App\AsientoContable\PensionFund\PensionFund;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class PayrollController extends Controller
{
    private $fileRepo;
    private $conceptRepo;

    public function __construct(IFile $IFile,IConcept $IConcept)
    {
        $this->fileRepo = $IFile;
        $this->conceptRepo = $IConcept;
    }

    public function index()
    {
        return view('customers.collaborators.monthly-payroll.index',[
            'files' => $this->fileRepo->listFiles()
        ]);
    }

    public function show(int $customer_id, int $id)
    {
        return view('customers.collaborators.monthly-payroll.show',[
            'file'     => $this->fileRepo->findFileById($id),
            'payrolls' => $this->conceptRepo->showConceptCollaboratorList($id),
            'files'    => $this->fileRepo->listFiles()
        ]);
    }



}
