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
        $data = $this->conceptRepo->showConceptCollaboratorList($id);

        $withoutCosts = collect($data)->filter(function ($value) {
            return (collect($value['centerCost'])->count() === 0);
        })->count();

        $moreOneCosts = collect($data)->filter(function ($value) {
            return (collect($value['centerCost'])->count() > 1);
        })->count();

        return view('customers.collaborators.monthly-payroll.show',[
            'file'         => $this->fileRepo->findFileById($id),
            'payrolls'     => $data,
            'moreCosts'    => $moreOneCosts,
            'withoutCosts' => $withoutCosts,
            'files'        => $this->fileRepo->listFiles()
        ]);
    }



}
