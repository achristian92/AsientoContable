<?php


namespace App\AsientoContable\Employees\AccountingSeating\Repositories;


use App\AsientoContable\Employees\AccountingSeating\Seating;
use Prettus\Repository\Eloquent\BaseRepository;

class SeatingRepo extends BaseRepository implements ISeating
{

    public function model(): string
    {
        return Seating::class;
    }

    public function listSeating(int $file)
    {
        return $this->model::with('employee')->where('file_id',$file)->get();
    }
}
