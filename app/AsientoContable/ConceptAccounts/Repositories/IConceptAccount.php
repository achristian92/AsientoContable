<?php


namespace App\AsientoContable\ConceptAccounts\Repositories;


use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Files\File;
use Illuminate\Support\Collection;

interface IConceptAccount
{
    public function listAccountsByFileId(int $file_id): Collection;
    public function createConceptAccount(string $header,$account,$value,Collaborator $employee,int $customer,File $file): void;

}
