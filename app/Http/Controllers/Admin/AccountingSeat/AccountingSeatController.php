<?php


namespace App\Http\Controllers\Admin\AccountingSeat;


use App\AsientoContable\Employees\AccountingSeating\Repositories\ISeating;
use App\AsientoContable\Files\Repositories\IFile;
use App\AsientoContable\Tools\UploadableTrait;
use App\Exports\EmployeeExport;
use App\Exports\SeatingExport;
use App\Http\Controllers\Controller;
use App\Models\History;
use Maatwebsite\Excel\Facades\Excel;

class AccountingSeatController extends Controller
{
    use UploadableTrait;

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

        $url = $this->handleDocumentS3(new SeatingExport($seating->toArray()),$nameFile);
        history(History::EXPORT_TYPE,"Exporto asiento generado $nameFile",$url);

        return Excel::download(new SeatingExport($seating->toArray()), $nameFile);
    }
}
