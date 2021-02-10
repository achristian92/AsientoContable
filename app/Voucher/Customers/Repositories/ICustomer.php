<?php


namespace App\Voucher\Customers\Repositories;


use App\Voucher\Customers\Customer;
use App\Voucher\Providers\Provider;
use Illuminate\Support\Collection;

interface ICustomer
{
    public function findCustomerById(int $customer_id): Customer;

    public function createCustomer(array $data): Customer;

    public function updateCustomer(array $data, int $id): bool;

    public function listCustomers($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection;

    public function saveContacts(Customer $customer, array $data);

    public function updateContacts(Customer $customer, array $data);

    public function removeContacts(array $data);
}
