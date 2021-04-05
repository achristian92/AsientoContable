<?php


namespace App\Http\Controllers;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Employees\AccountingSeating\Seating;
use App\AsientoContable\Employees\CostEmployees\Repositories\ICostEmployee;
use App\AsientoContable\Files\File;
use App\AsientoContable\Files\Repositories\IFile;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\AsientoContable\Tools\NestedsetTrait;
use Carbon\Carbon;


class TestController extends Controller
{
    use NestedsetTrait;

    private $companyRepo,$terms,$userRepo,$conceptRepo,$headerRepo,$costEmployee,$fileRepo;

    public function __construct(IFile $IFile,IConcept $IConcept,IHeader $IHeader,ICostEmployee $ICostEmployee)
    {
        $this->fileRepo = $IFile;
        $this->conceptRepo = $IConcept;
        $this->headerRepo = $IHeader;
        $this->costEmployee = $ICostEmployee;
    }

    public function __invoke()
    {
        $IDS = $this->conceptRepo->employeeIDS(2);
        $file = $this->fileRepo->findFileById(2);
        $payrollDate = Carbon::parse($file->created_at);

        $data =  $IDS->map(function ($id) use ($file,$payrollDate) {
            $employee  = Collaborator::find($id);
            return [
                'workedID'    => $employee->id,
                'fileID'      => $file->id,
                'customerID'  => $file->customer_id,
                'worked'      => substr($employee->full_name,0,10),
                'nroDoc'      => $employee->nro_document,
                'createdAt'   => $payrollDate->format('d/m/Y'),
                'month'       => $payrollDate->format('m'),
                'accounts'    => $this->conceptRepo->accounts(['file_id'=> $file->id, 'collaborator_id'=> $id])->toArray(),
                'costCenters' => $this->conceptRepo->costCenterEmployee(['file_id'=> $file->id, 'collaborator_id'=> $id])
            ];
        });

        $onlyCost =  collect($data)->filter(function ($employee) {
            return  count($employee['costCenters']) > 0;
        })->values();

        $result = $onlyCost->each(function ($employee) {
            if (count($employee['costCenters']) === 1) {

            } else {

            }
        });

        dd($result);
    }






}
