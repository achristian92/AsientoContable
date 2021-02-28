<?php


namespace App\AsientoContable\Users\Repositories;


use App\Models\User;
use Illuminate\Support\Collection;

interface IUser
{
    public function findUserById(int $id): User;

    public function createUser(array $data): User;
    public function updateUser(array $data,int $id): bool;

    public function listUsers($columns = array('*'), string $orderBy = 'name', string $sortBy = 'asc') : Collection;

    public function assignDefaultRole(User $user): User;

    public function syncCustomers(User $user, array $params): void;
    public function detachCustomers(User $user): void;
}
