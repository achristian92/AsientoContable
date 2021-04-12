<?php


namespace App\AsientoContable\Headers\Repositories;


use App\AsientoContable\Headers\Header;
use App\Models\History;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;

class HeaderRepo extends BaseRepository implements IHeader
{

    public function model(): string
    {
        return Header::class;
    }

    public function findHeaderById(int $customer_id): Header
    {
        return $this->model->findOrFail($customer_id);
    }

    public function createHeader(array $data): Header
    {
        if (!$data['order'])
            $data['order'] = $this->model::getNextOrderNumber();

        $data['customer_id'] = customerID();
        $data['slug'] = Str::slug($data['name'],'_');
        $header = $this->model->create($data);
        history(History::CREATED_TYPE,"Creó la cabecera $header->name");

        return $header;
    }

    public function updateHeader(array $data, int $id): bool
    {
        $data['is_active'] = isset($data['is_active']);
        $header = $this->findHeaderById($id);
        if ($header->is_required)
            $data['name'] = $header->name;
         else
            $data['slug'] = slug($data['name']);

        return $header->update($data);
    }

    public function listHeaders($columns = array('*'), string $orderBy = 'order', string $sortBy = 'asc'): Collection
    {
        return $this->model::with('account')
                    ->where('customer_id',customerID())
                    ->where('is_active',true)
                    ->orderBy($orderBy,$sortBy)
                    ->get($columns);
    }

    public function listHeadersAll($columns = array('*'), string $orderBy = 'order', string $sortBy = 'asc'): Collection
    {
        return $this->model::with('account')->where('customer_id',customerID())
            ->orderBy($orderBy,$sortBy)
            ->get($columns);
    }

    public function isAssignedAccountWithHeaders(): bool
    {
        $collection = $this->model::where('customer_id',customerID())
                    ->where('has_account',true)
                    ->get();

        $filtered = $collection->whereNull('account_plan_id')->count();
        return $filtered === 0;

    }


}
