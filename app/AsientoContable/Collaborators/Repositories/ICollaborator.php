<?php


namespace App\AsientoContable\Collaborators\Repositories;


use Illuminate\Support\Collection;

interface ICollaborator
{
    public function listCollaborators(string $order = 'full_name', string $sort = 'asc'): Collection;

}
