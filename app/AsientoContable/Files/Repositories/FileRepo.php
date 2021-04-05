<?php


namespace App\AsientoContable\Files\Repositories;


use App\AsientoContable\Employees\CostEmployees\Transformations\CostEmployeeTrait;
use App\AsientoContable\Files\File;
use Prettus\Repository\Eloquent\BaseRepository;

class FileRepo extends BaseRepository implements IFile
{
    use CostEmployeeTrait;

    public function model(): string
    {
        return File::class;
    }

    public function findFileById(int $id): File
    {
        return $this->model::findOrFail($id);
    }

    public function listFiles(string $orderBy = 'id', string $sortBy = 'desc')
    {
        return $this->model::with('concepts','assignments','seating')->where('customer_id',customerID())
            ->orderBy($orderBy,$sortBy)
            ->get()
            ->transform(function ($value) {
                $model = new File();
                $model->id = $value->id;
                $model->name = $value->name;
                $model->totalConcepts = $value->concepts->unique('collaborator_id')->count();
                $model->totalAssignments = $value->assignments->unique('collaborator_id')->count();
                $model->totalSeating = $value->seating->unique('collaborator_id')->count();
                return $model;
            });
    }


    public function listAssignments(int $id)
    {
        $file = $this->model::with('assignments','assignments.employee')->findOrFail($id);

        return $file->assignments->transform(function ($item) {
            return $this->transformCostEmployee($item);
        })->groupBy('worked')
        ->transform(function ($collection) {
            return $this->transformAgroupCostEmployee($collection);
        })->values();
    }


}
