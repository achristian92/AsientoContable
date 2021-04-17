<?php

namespace App\Imports;

use App\AsientoContable\Customers\Customer;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\PensionFund\PensionFund;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CustomersImport implements ToCollection,WithHeadingRow,WithValidation
{
    private $headers;
    private $pensions;

    public function __construct(array $baseHeaders, array $basePensionsFund)
    {
        $this->headers = $baseHeaders;
        $this->pensions = $basePensionsFund;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $collection)
    {
        $collection->each(function ($row) {
             $customerID = $this->createOrUpdateCustomer($row->toArray());
             $this->addHeadersDefault($customerID);
             $this->addPensionDefault($customerID);
        });
    }

    public function rules(): array
    {
        return [
            '*.empresa' => 'required',
            '*.ruc'     => 'required',
        ];
    }

    public function createOrUpdateCustomer(array $row): int
    {
        $customer =  Customer::updateOrCreate(
            [
                'ruc'     => $row['ruc'],
            ],
            [
                'name'    => $row['empresa'],
                'address' => $row['direccion'],
            ]
        );
        return intval($customer->id);
    }

    public function addHeadersDefault(int $customer): void
    {
        foreach ($this->headers as $header) {
            $header['customer_id'] = $customer;
            Header::create($header);
        }
    }

    public function addPensionDefault(int $customer): void
    {
        foreach ($this->pensions as $pension) {
            $pension['customer_id'] = $customer;
            PensionFund::create($pension);
        }
    }
}
