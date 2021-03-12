<?php


namespace App\AsientoContable\Files\Repositories;


use App\AsientoContable\Files\File;

interface IFile
{
    public function findFileById(int $id): File;

    public function listFiles(string $orderBy = 'id', string $sortBy = 'desc');

}
