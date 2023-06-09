<?php


namespace App\AsientoContable\Files\Repositories;


use App\AsientoContable\Employees\CostEmployees\Transformations\CostEmployeeTrait;
use App\AsientoContable\Files\File;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\Tools\UploadableTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;

class FileRepo extends BaseRepository implements IFile
{
    use CostEmployeeTrait,UploadableTrait;

    public function model(): string
    {
        return File::class;
    }

    public function findFileById(int $id): File
    {
        return $this->model::findOrFail($id);
    }

    public function listFiles(string $orderBy = 'month_payroll', string $sortBy = 'desc')
    {
        return $this->model::with('concepts','assignments','seating')
            ->where('month_payroll','>=',now()->startOfMonth()->subMonths(3)->format('Y-m-d'))
            ->where('customer_id',customerID())
            ->orderBy($orderBy,$sortBy)
            ->get()
            ->transform(function ($value) {
                $model = new File();
                $model->id = $value->id;
                $model->name = $value->name;
                $model->isOpen = $value->status === $this->model::STATUS_OPEN;
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


    public function fileUpdateOrCreate(Request $request): File
    {
        $date = Carbon::parse($request->month);

        return $this->model::updateOrCreate(
            [
                'month_payroll' => $date,
                'customer_id'   => customerID()
            ],
            [
                'headers'       => json_encode(Header::where('customer_id',customerID())->get()),
                'url_file'      => $this->handleUploadedDocument($request->file('file_upload'),'import'),
                'name'          => ucfirst($date->monthName).'-'.$date->year,
                'user_id'       => \Auth::id(),
                'status'        => $this->model::STATUS_OPEN
            ]
        );
    }

    public function listHeaderNamesByType(int $id, string $type): array
    {
        $file = $this->findFileById($id);
        $headers = collect(json_decode($file->headers));
        return $headers->where('type',$type)->pluck('name')->toArray();
    }
}
