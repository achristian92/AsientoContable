<?php


namespace App\AsientoContable\Employees\CostEmployees\Repositories;


use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use App\AsientoContable\Employees\CostEmployees\Transformations\CostEmployeeTrait;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class CostEmployeeRepo extends BaseRepository implements ICostEmployee
{
    use CostEmployeeTrait;

    public function model(): string
    {
        return CostEmployee::class;
    }

    public function findCostEmployeeById(int $customer_id): CostEmployee
    {
        // TODO: Implement findCostEmployeeById() method.
    }

    public function createCostEmployee(array $data): void
    {
        $this->model::where('file_id',$data['file_id'])
                    ->where('collaborator_id',$data['collaborator_id'])
                    ->delete();

        foreach ($data['costs'] as $cost) {
            $cost['customer_id']     = customerID();
            $cost['collaborator_id'] = $data['collaborator_id'];
            $cost['file_id']         = $data['file_id'];
            $this->model::create($cost);
        }
    }

    public function updateCostEmployee(array $data, int $id): bool
    {
        // TODO: Implement updateCostEmployee() method.
    }


    public function listCostEmployees(int $employee_id, int $file_id): Collection
    {
        return $this->model::with('employee','cost')
                    ->where(['collaborator_id' => $employee_id,'file_id' => $file_id])
                    ->get()
                    ->transform(function ($item) {
                return $this->transformCostEmployee($item);
            });
    }
}
