<?php


namespace App\AsientoContable\PensionFund;


use App\AsientoContable\Concepts\Concept;
use Illuminate\Support\Collection;

trait PensionTrait
{
    public function searchPensionSlug($pension_code): string
    {
        switch (strtolower($pension_code)) {
            case "in":
                return "in_afp_integra";
                break;
            case "ha":
                return "ha_afp_habitat";
                break;
            case "pr":
                return "pr_afp_profuturo";
                break;
            case "pm":
                return "pm_afp_prima";
                break;
            default :
                return 'onp';
                break;
        }
    }

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
