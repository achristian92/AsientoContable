<?php


namespace App\Voucher\Users\Repositories;


use App\Models\User;
use Illuminate\Support\Collection;

interface IUser
{
    public function createUser(array $data): User;

    public function listUsers($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection;

}
