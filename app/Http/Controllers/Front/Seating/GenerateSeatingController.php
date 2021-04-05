<?php


namespace App\Http\Controllers\Front\Seating;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Employees\AccountingSeating\Seating;
use App\AsientoContable\Files\File;
use App\AsientoContable\Files\Repositories\IFile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GenerateSeatingController extends Controller
{
    private $conceptRepo,$fileRepo;

    public function __construct(IConcept $IConcept,IFile $IFile)
    {
        $this->conceptRepo = $IConcept;
        $this->fileRepo = $IFile;
    }

    public function __invoke(Request $request)
    {
        $IDS = $this->employeeIDS($request);

        $data = $this->transformData($IDS,$request->input('file_id'));

        $exchangeRate = 3.76;

        $data->map(function ($employee,$key) use ($exchangeRate) {
            $nro_seat  = Seating::getNextSeatNumber($employee['fileID']);

            if (count($employee['costCenters']) === 1) {
                return collect($employee['accounts'])->transform(function ($account) use ($employee,$key,$exchangeRate,$nro_seat) {
                    $isExpense = $account['type'] === AccountPlan::TYPE_EXPENSE;
                    $penValue  = $account['value'];
                    $USDValue  = $penValue/$exchangeRate;
                    Seating::firstOrCreate(
                        [
                            'collaborator_id' => $employee['workedID'],
                            'file_id'         => $employee['fileID'],
                            'customer_id'     => $employee['customerID']
                        ],
                        [
                            'sub_diario'      => 7,
                            'nro_asiento'     => $nro_seat,
                            'l_registro'      => 31,
                            'fecha_registro'  => $employee['createdAt'],
                            'mes'             => $employee['month'],
                            'cuenta_contable' => $account['nroAccount'],
                            'debe'            => $isExpense ? $penValue : 0,
                            'haber'           => !$isExpense ? $penValue : 0,
                            'moneda'          => 'S',
                            'tipo_cambio'     => $exchangeRate,
                            'debe_usd'        => $isExpense ? number_format($USDValue,2) : 0,
                            'haber_usd'       => !$isExpense ? number_format($USDValue,2) : 0,
                            'glosa_asiento'   => 'PL/'.$employee['worked'].'/'.$account['concept'],
                            'nro_documento'   => $employee['nroDoc'],
                            'doc'             => 'PL',
                            'nro_doc'         => 'PL'.(int)$employee['month'].'000'.($nro_seat),
                            'fecha_doc'       => $employee['createdAt'],
                            'fecha_vencimiento' => '',
                            'cost'            => $employee['costCenters'][0]['code'],
                            'cost2'           => '',
                        ]
                    );
                });
            }
            return '';
        });

        return response()->json([
            'msg' => 'Asientos contables generados'
        ]);
    }

    private function transformData($IDS,int $file_id)
    {
        $file = $this->fileRepo->findFileById($file_id);
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

}
