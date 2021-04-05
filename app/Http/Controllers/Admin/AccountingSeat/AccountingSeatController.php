<?php


namespace App\Http\Controllers\Admin\AccountingSeat;


use App\AsientoContable\Employees\AccountingSeating\Repositories\ISeating;
use App\AsientoContable\Files\Repositories\IFile;
use App\Exports\PlanCounterExportDays;
use App\Exports\SeatingExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AccountingSeatController extends Controller
{
    private $fileRepo,$seatingRepo;

    public function __construct(IFile $IFile,ISeating $ISeating)
    {
        $this->fileRepo = $IFile;
        $this->seatingRepo = $ISeating;
    }

    public function index()
    {
        return view('customers.collaborators.accounting-seat.index',[
            'files' => $this->fileRepo->listFiles()
        ]);
    }

    public function show(int $customer, int $file)
    {
        return view('customers.collaborators.accounting-seat.show',[
            'file' => $this->fileRepo->findFileById($file),
            'files' => $this->fileRepo->listFiles(),
            'seating' => $this->seatingRepo->listSeating($file)
        ]);
    }

    public function export(int $customer, int $id)
    {
        $file = $this->fileRepo->findFileById($id);
        $nameFile = 'Asientos-'.slug($file->name,'-').'.xlsx';
        $seating = $this->seatingRepo->listSeating($id);
        return Excel::download(new SeatingExport($seating->toArray()), $nameFile);
    }
}
