<?php


namespace App\AsientoContable\PensionFund;


use App\AsientoContable\Concepts\Concept;
use Illuminate\Support\Collection;

trait PensionTrait
{

    public function searchPensionName(Collection $concept, Collection $pensionsFund): string
    {
        $code = $concept->firstWhere('header',Concept::PENSION_SHORT)->value;
        if ($this->hasPensionONP($concept))
            return Concept::ONP;

        return $pensionsFund->firstWhere('short',$code)->name;
    }

    public function hasPensionONP($collection): bool
    {
        if (strtolower($collection->firstWhere('header',Concept::PENSION_SHORT)->value) === 'on')
            return true;
        return false;
    }

}
