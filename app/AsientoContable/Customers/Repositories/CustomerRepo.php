<?php


namespace App\AsientoContable\Customers\Repositories;


use App\AsientoContable\Customers\Customer;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class CustomerRepo extends BaseRepository implements ICustomer
{
    public function model()
    {
        return Customer::class;
    }

    public function findCustomerById(int $customer_id): Customer
    {
        return $this->model->findOrFail($customer_id);
    }

    public function createCustomer(array $data): Customer
    {
        return $this->model->create($data);
    }

    public function updateCustomer(array $data, int $id): bool
    {
        $customer = $this->findCustomerById($id);
        return $customer->update($data);
    }

    public function listCustomers($columns = array('*'), string $orderBy = 'name', string $sortBy = 'asc'): Collection
    {
        return $this->model->orderBy($orderBy,$sortBy)->get($columns);
    }


    public function deleteCustomer(int $id): bool
    {
        $customer = $this->findCustomerById($id);
        return $customer->update([ 'is_active'=> false ]);
    }

    public function listCustomersActivated($columns = array('*'), string $orderBy = 'name', string $sortBy = 'asc'): Collection
    {
        return $this->model->whereIsActive(true)->orderBy($orderBy,$sortBy)->get($columns);
    }
}
