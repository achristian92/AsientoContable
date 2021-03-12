<?php


namespace App\AsientoContable\Files\Repositories;


use App\AsientoContable\Files\File;
use Prettus\Repository\Eloquent\BaseRepository;

class FileRepo extends BaseRepository implements IFile
{

    public function model()
    {
        return File::class;
    }

    public function findFileById(int $id): File
    {
        return $this->model::findOrFail($id);
    }

    public function listFiles(string $orderBy = 'id', string $sortBy = 'desc')
    {
        return $this->model::with('concepts')->where('customer_id',customerID())
            ->orderBy($orderBy,$sortBy)
            ->get()
            ->transform(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'totalEmployee' => $item->concepts->unique('collaborator_id')->count()
                ];
            });
    }

}
