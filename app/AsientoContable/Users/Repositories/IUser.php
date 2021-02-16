<?php


namespace App\AsientoContable\Users\Repositories;


use App\Models\User;
use Illuminate\Support\Collection;

interface IUser
{
    public function findUserById(int $id): User;

    public function createUser(array $data): User;

    public function listUsers($columns = array('*'), string $orderBy = 'name', string $sortBy = 'asc') : Collection;

}
