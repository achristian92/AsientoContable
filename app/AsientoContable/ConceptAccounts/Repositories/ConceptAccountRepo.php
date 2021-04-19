<?php


namespace App\AsientoContable\ConceptAccounts\Repositories;


use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\ConceptAccounts\ConceptAccount;
use App\AsientoContable\Files\File;
use Prettus\Repository\Eloquent\BaseRepository;

class ConceptAccountRepo extends BaseRepository implements IConceptAccount
{

    public function model(): string
    {
        return ConceptAccount::class;
    }

    public function createConceptAccount(string $header,$account,$value,Collaborator $employee,int $customer,File $file): void
    {
        $this->model::updateOrCreate(
            [
                'header'          => $header,
                'payroll_date'    => $file->month_payroll,
                'collaborator_id' => $employee->id,
                'customer_id'     => $customer,
                'file_id'         => $file->id
            ],
            [
                'account' => json_encode($account),
                'value'   => trim($value),
                'type'    => $account['type']
            ]
        );
    }
}
