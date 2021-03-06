<?php

namespace App\Imports;

use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\CenterCosts\Repositories\CenterCostRepo;
use App\AsientoContable\Collaborators\Repositories\CollaboratorRepo;
use App\AsientoContable\ConceptAccounts\Repositories\ConceptAccountRepo;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\CostsCenter2\CostCenter2;
use App\AsientoContable\Files\File;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\PensionFund\Repositories\PensionFundRepo;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PayrollImport implements ToCollection,WithHeadingRow,WithValidation
{
    private $customer, $file,$pensionRepo,$conceptAccountRepo,$employeeRepo;

    public function __construct(int $customer,File $file)
    {
        $this->customer = $customer;
        $this->file = $file;
        $this->employeeRepo = resolve(CollaboratorRepo::class);
        $this->pensionRepo = resolve(PensionFundRepo::class);
        $this->conceptAccountRepo = resolve(ConceptAccountRepo::class);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $collection)
    {
        $collection->each(function ($row) {
            $employee = $this->employeeRepo->updateOrCreateEmployee($row->toArray(),$this->customer);

            if(!$this->hasPensionOnp($row))
                $this->conceptAccountRepo->createConceptAccount(Concept::AFP_CONTRIBUTION,$this->pensionAccount($row),$this->totalAFP($row), $employee,$this->customer,$this->file);

            $row->each(function ($item,$row) use ($employee) {
                $header = Header::where('slug',$row)
                                ->where('customer_id',$this->customer)
                                ->first();
                if($header) {
                    if ($header->account_plan_id)
                        $this->conceptAccountRepo->createConceptAccount($header->name,$header->account,$item, $employee,$this->customer,$this->file);

                    Concept::updateOrCreate(
                        [
                            'header'          => $header->name,
                            'payroll_date'    => $this->file->month_payroll,
                            'collaborator_id' => $employee->id,
                            'customer_id'     => $this->customer,
                            'file_id'         => $this->file->id
                        ],
                        [
                            'value' => trim($item),
                        ]
                    );
                }
            });
        });
    }

    private function pensionAccount($row): AccountPlan
    {
        $pension = $this->pensionRepo->findPensionByShort($row[slug(Concept::PENSION_SHORT)],$this->customer);
        return $pension->account; //Cuenta contable a la q pertecenece
    }

    private function hasPensionOnp($row): bool
    {
        if (strtolower($row[slug(Concept::PENSION_SHORT)]) === 'on')
            return true;
        return false;
    }

    private function totalAFP(Collection $row): float
    {
        $contribution = floatval($row[slug(Concept::AFP_CONTRIBUTION)]);
        $sure = floatval($row[slug(Concept::AFP_SURE_PRIME)]);
        $commission = floatval($row[slug(Concept::AFP_COMISSION)]);
        return $contribution + $sure + $commission;
    }

    public function rules(): array
    {
        $costCenter = resolve(CenterCostRepo::class);
        $costs = $costCenter->listCostsCenter()->pluck('code')->toArray();

        $costs2 = CostCenter2::where('customer_id',$this->customer)->get()->pluck('code');
        $pensions = $this->pensionRepo->listPensionsFund()->pluck('short')->toArray();

        return [
            '*.codigo'         => 'required',
            '*.trabajador'     => 'required',
            '*.nro_identidad'  => 'required',
            '*.centro_costo'   => ['nullable',Rule::in($costs)],
            '*.centro_costo2'   => ['nullable',Rule::in($costs2)],
            '*.fecha_ingreso'  => 'required|date_format:d/m/Y',
            '*.pension'        => ['required',Rule::in($pensions)],
            '*.remuneracion_basica' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            '*.neto'           => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ];

    }
}
