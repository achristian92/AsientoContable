<?php


namespace App\AsientoContable\ConceptAccounts\Repositories;


use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\ConceptAccounts\ConceptAccount;
use Prettus\Repository\Eloquent\BaseRepository;

class ConceptAccountRepo extends BaseRepository implements IConceptAccount
{

    public function model(): string
    {
        return ConceptAccount::class;
    }

    public function createConceptAccount(string $header,$account,$value,Collaborator $employee,$fileDate,int $customer,int $file): void
    {
        $this->model::updateOrCreate(
            [
                'header'          => $header,
                'payroll_date'    => $fileDate,
                'collaborator_id' => $employee->id,
                'customer_id'     => $customer,
                'file_id'         => $file
            ],
            [
                'account' => json_encode($account),
                'value'   => trim($value)
            ]
        );
    }
}
