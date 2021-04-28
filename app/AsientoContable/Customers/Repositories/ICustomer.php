<?php


namespace App\AsientoContable\Customers\Repositories;


use App\AsientoContable\Customers\Customer;
use Illuminate\Support\Collection;

interface ICustomer
{
    public function findCustomerById(int $customer_id): Customer;

    public function createCustomer(array $data): Customer;

    public function updateCustomer(array $data, int $id): bool;

    public function searchCustomer(string $text) : Collection;

    public function listCustomers($columns = array('*'), string $orderBy = 'name', string $sortBy = 'asc') : Collection;

    public function listCustomersActivated($columns = array('*'), string $orderBy = 'name', string $sortBy = 'asc') : Collection;

    public function deleteCustomer(int $id): bool;
}
