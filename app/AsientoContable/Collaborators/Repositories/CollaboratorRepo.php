<?php


namespace App\AsientoContable\Collaborators\Repositories;


use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Concepts\Concept;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class CollaboratorRepo extends BaseRepository implements ICollaborator
{

    public function model(): string
    {
        return Collaborator::class;
    }

    public function findEmployeeByNroDocument(string $nro_document, int $customer): Collaborator
    {
        return $this->model::where('customer_id',$customer)
            ->where('nro_document',$nro_document)
            ->first();
    }

    public function listCollaborators(array $columns = ['*'], string $order = 'full_name', string $sort = 'asc'): Collection
    {
        return $this->model->whereCustomerId(customerID())
                    ->orderBy($order, $sort)
                    ->get($columns);
    }

    public function listEmployeeWithOutCostCenter(int $file, array $columns = ['*'], string $order = 'full_name', string $sort = 'asc'): Collection
    {
        $employeeIDS= Concept::where(['file_id' => $file,'header' => Concept::COSTCENTER])
                        ->get()
                        ->filter(function ($value) {
                            return !$value->value;
                        })
                        ->pluck('collaborator_id');

        return $this->model::whereCustomerId(customerID())
                           ->whereIn('id',$employeeIDS)
                            ->orderBy($order, $sort)
                            ->get($columns);
    }


    public function updateOrCreateEmployee(array $params, int $customer): Collaborator
    {
        return $this->model::updateOrCreate(
            [
                'nro_document' => $params[slug(Concept::NRO_DOC)],
                'customer_id'  => $customer
            ],
            [
                'full_name'       => $params[slug(Concept::FULL_NAME)],
                'code'            => $params[slug(Concept::CODE)],
                'date_start_work' => $params[slug(Concept::DATE_ENTRY)],
            ]
        );
    }
}
