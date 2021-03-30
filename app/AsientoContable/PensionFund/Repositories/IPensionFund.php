<?php


namespace App\AsientoContable\PensionFund\Repositories;


use App\AsientoContable\PensionFund\PensionFund;

interface IPensionFund
{
    public function listPensionsFund();

    public function findPensionById(int $id): PensionFund;

    public function createPensionFund(array $params);

    public function updatePensionFund(array $params, int $id): bool;

    public function isAssignedAccountWithPensions(): bool;

}
