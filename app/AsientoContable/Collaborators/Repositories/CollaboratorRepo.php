<?php


namespace App\AsientoContable\Collaborators\Repositories;


use App\AsientoContable\Collaborators\Collaborator;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class CollaboratorRepo extends BaseRepository implements ICollaborator
{

    public function model()
    {
        return Collaborator::class;
    }

    public function listCollaborators(string $order = 'full_name', string $sort = 'asc'): Collection
    {
        return $this->model->whereCustomerId(customerID())->orderBy($order, $sort)->get();
    }
}
