<?php


namespace App\AsientoContable\Concepts\Repositories;


use Illuminate\Support\Collection;

interface IConcept
{
    public function showConceptCollaboratorList(int $file_id): array;

}
