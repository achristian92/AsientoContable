<?php


namespace App\AsientoContable\Headers\Repositories;


use App\AsientoContable\Headers\Header;
use Illuminate\Support\Collection;

interface IHeader
{
    public function findHeaderById(int $customer_id): Header;

    public function createHeader(array $data): Header;

    public function updateHeader(array $data, int $id): bool;

    public function listHeaders($columns = array('*'), string $orderBy = 'order', string $sortBy = 'asc') : Collection;

    public function isAssignedAccountWithHeaders(): bool;

    public function listHeadersByType(string $type): Collection;

}
