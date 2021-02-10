<?php


namespace App\Voucher\Customers\Repositories;


use App\Voucher\Contacts\Contact;
use App\Voucher\Customers\Customer;
use App\Voucher\Providers\Provider;
use Auth;
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
        $provider = $this->findCustomerById($id);
        return $provider->update($data);
    }

    public function listCustomers($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->orderBy($orderBy,$sortBy)->get($columns);
    }

    public function saveContacts(Customer $customer, array $data)
    {
        collect($data)->each(function ($contact) use ($customer){
            $customer->contacts()->create($contact);
        });
    }

    public function updateContacts(Customer $customer, array $data)
    {
        collect($data)->each(function ($contact) use ($customer) {
            $model = $customer->contacts()->firstOrNew([
                'id' => $contact['id']
            ]);
            $model->fill($contact)->save();
        });
    }

    public function removeContacts(array $data)
    {
        Contact::whereIn('id',$data)->delete();
    }
}
