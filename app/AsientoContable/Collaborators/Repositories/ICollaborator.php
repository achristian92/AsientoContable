<?php


namespace App\AsientoContable\Collaborators\Repositories;


use Illuminate\Support\Collection;

interface ICollaborator
{
    public function listCollaborators(array $columns = ['*'], string $order = 'full_name', string $sort = 'asc'): Collection;

}
