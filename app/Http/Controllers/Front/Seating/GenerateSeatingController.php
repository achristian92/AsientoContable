<?php


namespace App\Http\Controllers\Front\Seating;

use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Currencies\Currency;
use App\AsientoContable\Employees\AccountingSeating\Repositories\ISeating;
use App\AsientoContable\Employees\AccountingSeating\Seating;
use App\AsientoContable\Files\File;
use App\AsientoContable\Files\Repositories\IFile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GenerateSeatingController extends Controller
{
    private $conceptRepo,$fileRepo,$seatRepo;

    public function __construct(IConcept $IConcept,IFile $IFile,ISeating $ISeating)
    {
        $this->conceptRepo = $IConcept;
        $this->fileRepo = $IFile;
        $this->seatRepo = $ISeating;
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        //TODO REFACTOIZAR USA 1268 QURERIES PARA GENERAR ASIENTOS
        $IDS = $this->employeeIDS($request);

        $data = $this->transformData($IDS,$request->input('file_id'));

        $exchangeRate = floatval(Currency::first()->rate);

        $data->map(function ($employee) use ($exchangeRate) {
            $nro_seat  = Seating::getNextSeatNumber($employee['fileID'],$employee['workedID']);

            if (count($employee['costCenters']) === 1) {
                collect($employee['accounts'])->each(function ($account) use ($employee,$exchangeRate,$nro_seat) {
                    $this->seatRepo->buildSeating($employee,$account,$employee['costCenters'][0],$nro_seat,$exchangeRate,false);
                });
            }
            else {
                collect($employee['accounts'])->each(function ($account) use ($employee,$exchangeRate,$nro_seat) {
                    if (substr($account['nroAccount'],0,2) === "62") {
                        collect($employee['costCenters'])->each(function ($center) use ($account,$employee,$exchangeRate,$nro_seat) {
                            $this->seatRepo->buildSeating($employee,$account,$center,$nro_seat,$exchangeRate,true);
                        });
                    } else {
                        $this->seatRepo->buildSeating($employee,$account,$employee['costCenters'][0],$nro_seat,$exchangeRate,false);
                    }
                });
            }
        });

        $this->updateFileStatus($request);

        return response()->json([
            'msg' => 'Asientos contables generados',
            'file' => $this->fileRepo->findFileById($request->input('file_id'))
        ]);
    }

    private function transformData($IDS,int $file_id)
    {
        $file = $this->fileRepo->findFileById($file_id)->load('concepts');
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
                'costCenters2'=> $file->concepts->where('header',Concept::COSTCENTER2)
                                    ->where('collaborator_id',$employee->id)
                                    ->first()
                                    ->value,
                'accounts'    => $this->conceptRepo->accounts(['file_id'=> $file->id, 'collaborator_id'=> $id])->toArray(),
                'costCenters' => $this->conceptRepo->costCenterEmployee(
                    $file->concepts,
                    ['file_id'=> $file->id, 'collaborator_id'=> $id],
                    Cost::where('customer_id',customerID())->get()
                )
            ];
        });

        return $data->filter(function ($employee) {
            return  count($employee['costCenters']) > 0;
        })->values();
    }

    private function employeeIDS(Request $request): Collection
    {
        if ($request->input('all',true))
            return $this->conceptRepo->employeeIDS($request->input('file_id'));

        return collect($request->input('employeeIDS'));
    }

    public function updateFileStatus(Request $request): void
    {
        $file = File::with('concepts','seating')->find($request->input('file_id'));
        $totalConcepts = $file->concepts->unique('collaborator_id')->count();
        $totalSeating = $file->seating->unique('collaborator_id')->count();
        if ($totalConcepts === $totalSeating) {
            $file->status = File::STATUS_CLOSE;
            $file->save();
        }

    }

}
