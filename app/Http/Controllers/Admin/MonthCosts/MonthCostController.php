<?php


namespace App\Http\Controllers\Admin\MonthCosts;

use App\AsientoContable\Files\Repositories\IFile;
use App\Http\Controllers\Controller;

class MonthCostController extends Controller
{
    private $fileRepo;

    public function __construct(IFile $IFile)
    {
        $this->fileRepo = $IFile;
    }

    public function index()
    {
        return view('customers.collaborators.month-costs.index',[
            'files' => $this->fileRepo->listFiles()
        ]);
    }

    public function show(int $customer, int $file)
    {
        return view('customers.collaborators.assign-costs.index',[
            'file' => $this->fileRepo->findFileById($file),
            'files' => $this->fileRepo->listFiles(),
            'assigns' => $this->fileRepo->listAssignments($file)
        ]);
    }

}
