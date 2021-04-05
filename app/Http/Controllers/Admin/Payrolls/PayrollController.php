<?php


namespace App\Http\Controllers\Admin\Payrolls;


use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Files\Repositories\IFile;
use App\Http\Controllers\Controller;

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
            'payrolls' => $this->conceptRepo->showConceptCollaboratorList($id),
            'files'    => $this->fileRepo->listFiles()
        ]);
    }



}
