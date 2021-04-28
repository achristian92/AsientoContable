<?php


namespace App\AsientoContable\Customers\Repositories;


use App\AsientoContable\Customers\Customer;
use App\Mail\SendEmailNewCustomer;
use App\Models\History;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Prettus\Repository\Eloquent\BaseRepository;

class CustomerRepo extends BaseRepository implements ICustomer
{
    public function model(): string
    {
        return Customer::class;
    }

    public function findCustomerById(int $customer_id): Customer
    {
        return $this->model->findOrFail($customer_id);
    }

    public function createCustomer(array $data): Customer
    {
        $data['name'] = strtoupper($data['ruc']);
        $data['raw_password'] = $data['ruc'];
        $data["password"]     = bcrypt($data['ruc']);
        $customer             = $this->model->create($data);

        $this->sendEmailNewCredentials($customer);
        history(History::CREATED_TYPE,"Creó el cliente $customer->name");
        return $customer;
    }

    public function updateCustomer(array $data, int $id): bool
    {
        $customer = $this->findCustomerById($id);
        if ($customer->email !== $data['email']) {
            $data['raw_password'] = $data['ruc'];
            $data["password"]     = bcrypt($data['ruc']);
        }

        $email = $customer->email;
        $customer->update($data);

        history(History::UPDATED_TYPE,"Actualizó el cliente $customer->name");


        if ($email !== $data['email'])
            $this->sendEmailNewCredentials($this->findCustomerById($id));

        return true;
    }

    public function listCustomers($columns = array('*'), string $orderBy = 'name', string $sortBy = 'asc'): Collection
    {
        $user = \Auth::user();
        if ($user->all_customers)
            return $this->model->orderBy($orderBy,$sortBy)->get($columns);

        return $user->customers()->orderBy($orderBy,$sortBy)->get($columns);
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
    public function sendEmailNewCredentials(Customer $customer)
    {
        if ($customer->email)
            Mail::to($customer->email)->send(new SendEmailNewCustomer($customer));
    }

    public function searchCustomer(string $text): Collection
    {
        return $this->model->searchCustomer($text);
    }
}
