<?php


namespace App\AsientoContable\Files\Repositories;


use App\AsientoContable\Files\File;
use Illuminate\Http\Request;

interface IFile
{
    public function findFileById(int $id): File;

    public function listFiles(string $orderBy = 'month_payroll', string $sortBy = 'desc');

    public function listAssignments(int $id);

    public function fileUpdateOrCreate(Request $request): File;

    public function listHeaderNamesByType(int $id,string $type): array;


}
