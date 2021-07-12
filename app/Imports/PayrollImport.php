<?php

namespace App\Imports;

use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\CenterCosts\Repositories\CenterCostRepo;
use App\AsientoContable\Collaborators\Repositories\CollaboratorRepo;
use App\AsientoContable\ConceptAccounts\ConceptAccount;
use App\AsientoContable\ConceptAccounts\Repositories\ConceptAccountRepo;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\CostsCenter2\CostCenter2;
use App\AsientoContable\Files\File;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\Headers\Repositories\HeaderRepo;
use App\AsientoContable\PensionFund\Repositories\PensionFundRepo;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PayrollImport implements ToCollection,WithHeadingRow,WithValidation,WithChunkReading
{
    private $customer, $file,$pensionRepo,$conceptAccountRepo,$employeeRepo,$headerRepo;

    public function __construct(int $customer,File $file)
    {
        $this->customer = $customer;
        $this->file = $file;
        $this->employeeRepo = resolve(CollaboratorRepo::class);
        $this->pensionRepo = resolve(PensionFundRepo::class);
        $this->conceptAccountRepo = resolve(ConceptAccountRepo::class);
        $this->headerRepo = resolve(HeaderRepo::class);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $collection) //9266
    {
        $headers = $this->headerRepo->listHeaders();
        $pensions = $this->pensionRepo->listPensionsFund();
        $collection->each(function ($row) use ($headers,$pensions) {
            $employee = $this->employeeRepo->updateOrCreateEmployee($row->toArray(),$this->customer);

            if(!$this->hasPensionOnp($row))
                $this->conceptAccountRepo->createConceptAccount(Concept::AFP_CONTRIBUTION,$this->pensionAccount($pensions,$row),$this->totalAFP($row), $employee,$this->customer,$this->file);

            $onlyHeadersExist = $row->filter(function ($item,$row) use ($headers) { //7407
                return  $headers->firstWhere('slug',$row);
            });

            $concepts = $onlyHeadersExist->map(function ($value1,$row) use ($headers,$employee) {
                return  [
                    'header'          => $headers->firstWhere('slug',$row)->name,
                    'payroll_date'    => $this->file->month_payroll,
                    'collaborator_id' => $employee->id,
                    'customer_id'     => $this->customer,
                    'file_id'         => $this->file->id,
                    'value'           => trim($value1)
                ];
            })->toArray();

            Concept::insert($concepts);

            $accounts = $row->filter(function ($item,$row) use ($headers) { //7407
                return  $headers->firstWhere('slug',$row) &&
                        $headers->firstWhere('slug',$row)->account_plan_id &&
                        !empty($item);
            })->map(function ($value1,$row) use ($headers,$employee) {
                $header = $headers->firstWhere('slug',$row);
                $nameAccountSecondary = !$header->is_account_main ? $header->name : null;
                $account = $this->transformAccountToJson($header->account,$nameAccountSecondary);
                return [
                        'header'          => $header->name,
                        'payroll_date'    => $this->file->month_payroll,
                        'collaborator_id' => $employee->id,
                        'customer_id'     => $this->customer,
                        'file_id'         => $this->file->id,
                        'account'         => json_encode($account),
                        'value'           => trim($value1),
                        'type'            => $account['type']
                    ];
            })->toArray();
            ConceptAccount::insert($accounts);

        });
    }

    private function pensionAccount($pensions,$row)
    {
        $pension = $pensions->firstWhere('short',$row[slug(Concept::PENSION_SHORT)]);
        return $this->transformAccountToJson($pension->account); //Cuenta contable a la q pertecenece
    }

    public function transformAccountToJson(AccountPlan $account, string $name = null): array
    {
        return [
            'code' => $account->code,
            'name' => is_null($name) ? $account->name : $name,
            'type' => $account->type,
            'customer_id' => $account->customer_id
        ];
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
            '*.cod_trab'         => 'required',
            '*.apellidos_y_nombres'     => 'required',
            '*.doc_identidad'  => 'numeric|required',
            '*.centro_costo'   => ['nullable',Rule::in($costs)],
            //'*.centro_costo2'   => ['nullable',Rule::in($costs2)],
            '*.fec_ing'  => 'required|date_format:d/m/Y',
            '*.fondo_de_pensiones' => ['required',Rule::in($pensions)],
            '*.remuneracion_basica' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            '*.neto'           => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ];

    }

    public function chunkSize(): int
    {
        return 500;
    }
}
