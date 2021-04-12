<?php


namespace App\AsientoContable\ConceptAccounts\Repositories;


use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Files\File;

interface IConceptAccount
{
    public function createConceptAccount(string $header,$account,$value,Collaborator $employee,int $customer,File $file): void;

}
