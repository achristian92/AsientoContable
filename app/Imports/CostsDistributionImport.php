<?php


namespace App\Imports;


use App\AsientoContable\CenterCosts\Repositories\CenterCostRepo;
use App\AsientoContable\Collaborators\Repositories\CollaboratorRepo;
use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CostsDistributionImport implements ToCollection,WithHeadingRow,WithValidation
{
    private $file,$customer;

    public function __construct(int $file_id,int $customer)
    {
        $this->file = $file_id;
        $this->customer = $customer;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $rows)
    {
        $rows->each(function ($row) {
            CostEmployee::updateOrCreate(
                [
                    'collaborator_id' => $this->searchEmployeeByNroDocument($row['nro_documento']),
                    'cost_id'         => $this->searchCostCenterByCode($row['cod_centro_costo']),
                    'file_id'         => $this->file
                ],
                [
                    'customer_id'     => $this->customer,
                    'percentage'      => $row['porcentaje']
                ]
            );
        });
    }

    public function rules(): array
    {
        $employeeRepo = resolve(CollaboratorRepo::class);
        $nro_documents = $employeeRepo->listEmployeeWithOutCostCenter($this->file)->pluck('nro_document')->toArray();

        $costCenter = resolve(CenterCostRepo::class);
        $costs = $costCenter->listCostsCenter()->pluck('code')->toArray();

        return [
            '*.porcentaje'       => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            '*.nro_documento'    => ['required',Rule::in($nro_documents)],
            '*.cod_centro_costo' => ['required',Rule::in($costs)],
        ];
    }

    private function searchEmployeeByNroDocument(string $nro_document): int
    {
        $employee = resolve(CollaboratorRepo::class);
        info("DOC :" .$nro_document);
        return $employee->findEmployeeByNroDocument($nro_document,$this->customer)->id;
    }

    private function searchCostCenterByCode(string $code): int
    {
        $employee = resolve(CenterCostRepo::class);
        return $employee->findCostCenterByCode($code,$this->customer)->id;
    }
}
