<?php


namespace App\AsientoContable\Collaborators\Repositories;


use App\AsientoContable\Collaborators\Collaborator;
use Illuminate\Support\Collection;

interface ICollaborator
{
    public function updateOrCreateEmployee(array $params,int $customer): Collaborator;

    public function findEmployeeByNroDocument(string $nro_document,int $customer): Collaborator;

    public function listCollaborators(array $columns = ['*'], string $order = 'full_name', string $sort = 'asc'): Collection;

    public function listEmployeeWithOutCostCenter(int $file,array $columns = ['*'], string $order = 'full_name', string $sort = 'asc'): Collection;

    public function exportEmployees(int $customer): array;

    public function listEmployeesByWhereIn(array $ids): Collection;
}
