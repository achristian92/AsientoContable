<?php


namespace App\Http\Controllers\Admin\Vouchers;


use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Employees\AccountingSeating\Repositories\ISeating;
use App\AsientoContable\Files\Repositories\IFile;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    private $fileRepo,$seatingRepo;

    public function __construct(ISeating $ISeating,IFile $IFile)
    {
        $this->fileRepo = $IFile;
        $this->seatingRepo = $ISeating;
    }

    public function index()
    {
        return view('customers.collaborators.vouchers.index',[
            'files' => $this->fileRepo->listFiles()
        ]);
    }

    public function show(int $customer, int $file)
    {
        return view('customers.collaborators.vouchers.show',[
            'employees' => $this->seatingRepo->listEmployeesGenerated($file),
            'file' => $this->fileRepo->findFileById($file),
            'files'    => $this->fileRepo->listFiles()
        ]);
    }

}
