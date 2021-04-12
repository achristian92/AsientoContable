<?php


namespace App\AsientoContable\Tools;


use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

trait DateTrait
{
    private function transformDateTime(string $value, string $format = 'd/m/Y')
    {
        try {
            return Carbon::instance(Date::excelToDateTimeObject($value))->format($format);
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }

}
