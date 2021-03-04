<?php


namespace App\AsientoContable\PensionFund\Repositories;


use App\AsientoContable\PensionFund\PensionFund;
use Prettus\Repository\Eloquent\BaseRepository;

class PensionFundRepo extends BaseRepository implements IPensionFund
{

    public function model()
    {
        return PensionFund::class;
    }

    public function listPensionsFund()
    {
        return $this->model::orderBy('code')->get();
    }

    public function findPensionById(int $id): PensionFund
    {
        return $this->model->findOrFail($id);
    }

    public function createPensionFund(array $params)
    {
        return $this->model::create($params);
    }

    public function updatePensionFund(array $params, int $id): bool
    {
        $pension = $this->findPensionById($id);
        return $pension->update($params);
    }
}
