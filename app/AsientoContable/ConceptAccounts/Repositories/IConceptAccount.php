<?php


namespace App\AsientoContable\ConceptAccounts\Repositories;


use App\AsientoContable\Collaborators\Collaborator;

interface IConceptAccount
{
    public function createConceptAccount(string $header,$account,$value,Collaborator $employee,$fileDate,int $customer,int $file): void;

}
