<?php

namespace App\Imports;

use App\AsientoContable\Customers\Customer;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\PensionFund\PensionFund;
use Arr;
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
             $customer = $this->createOrUpdateCustomer($row->toArray());
             if ($customer->wasRecentlyCreated) {
                 $this->addHeadersDefault($customer->id);
                 $this->addPensionDefault($customer->id);
             }
        });
    }

    public function rules(): array
    {
        return [
            '*.empresa' => 'required',
            '*.ruc'     => 'required',
        ];
    }

    public function createOrUpdateCustomer(array $row): Customer
    {
        return Customer::updateOrCreate(
            [
                'ruc'     => $row['ruc'],
            ],
            [
                'name'    => $row['empresa'],
                'address' => $row['direccion'],
            ]
        );
    }

    public function addHeadersDefault(int $customer): void
    {
        $newArray = [];
        foreach ($this->headers as $key => $arrayItem) {
            $newArray[$key] = Arr::add($arrayItem,'customer_id',$customer);
        }

        Header::insert($newArray);
    }

    public function addPensionDefault(int $customer): void
    {
        $newArray = [];
        foreach ($this->pensions as $key => $arrayItem) {
            $newArray[$key] = Arr::add($arrayItem,'customer_id',$customer);
        }

        PensionFund::insert($newArray);
    }

}
