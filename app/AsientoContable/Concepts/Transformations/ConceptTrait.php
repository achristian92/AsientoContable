<?php


namespace App\AsientoContable\Concepts\Transformations;


use App\AsientoContable\Concepts\Concept;
use Illuminate\Support\Collection;

trait ConceptTrait
{
    public function generalConceptCollaborator(Collection $collection, Collection $pensionFunds): array
    {
        $concept = $collection->first();
        return [
            'collaborator_id'   => $concept->collaborator_id,
            'file_id'           => $concept->file_id,
            'employee'          => $collection->firstWhere('header',Concept::FULL_NAME)->value,
            'workArea'          => $collection->firstWhere('header',Concept::CODAREA)->value ?? '--',
            'position'          => $collection->firstWhere('header',Concept::NAMEAREA)->value ?? '--',
            'withFamily'        => (bool)$collection->firstWhere('header', Concept::WITH_FAMILY)->value,
            'pension'           => $this->searchPensionName($collection,$pensionFunds),
            'totalIncome'       => $this->totalIncome($collection),
            'totalExpense'      => $this->totalExpense($collection),
            'totalContribution' => $this->totalContribution($collection),
            'netToPay'          => $this->netToPay($collection),
            'checked'           => false
        ];
    }



    public function basicInfo(Collection $concepts): array
    {
        return [
            'file_id'      => $concepts->first()->file_id,
            'customer_id'  => $concepts->first()->customer_id,
            'payrollMonth' => 'Planilla '.$concepts->first()->file->name,
            'worker'       => $concepts->firstWhere('header',Concept::FULL_NAME)->value,
            'remuneration' => 'S/'.number_format($this->basicRemuneration($concepts),2),
        ];
    }

    public function basicCosts(Collection $collection): array
    {
        return [
            'totalIncome'       => 'S/'.number_format($this->totalIncome($collection),2),
            'totalExpense'      => 'S/'.number_format($this->totalExpense($collection),2),
            'totalContribution' => 'S/'.number_format($this->totalContribution($collection),2),
            'netToPay'          => 'S/'.number_format($this->netToPay($collection),2),
        ];
    }

    public function basicRemuneration(Collection $concepts) :float
    {
        $concept = $concepts->firstWhere('header',Concept::BASIC_SALARY);
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }
    public function totalIncome(Collection $concepts): float
    {
        $concept = $concepts->firstWhere('header',Concept::TOTAL_INCOME);
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }
    public function totalExpense(Collection $concepts): float
    {
        $concept = $concepts->firstWhere('header',Concept::TOTAL_DISCOUNT);
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }
    public function totalContribution(Collection $concepts): float
    {
        $concept = $concepts->firstWhere('header',Concept::TOTAL_CONTRIBUTION);
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }
    public function netToPay(Collection $concepts): float
    {
        $concept = $concepts->firstWhere('header',Concept::NETO);
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }

    public function listIncome(Collection $concepts): Collection
    {
        $basic = $concepts->firstWhere('header',Concept::BASIC_SALARY);
        $family = $concepts->firstWhere('header',Concept::WITH_FAMILY);
        $collection = collect();
        $collection->push($basic);
        $collection->push($family);
        return $collection;
    }

    public function listExpenses(Collection $concepts): Collection
    {
        $contribution = $concepts->firstWhere('header',Concept::AFP_CONTRIBUTION);
        $sure = $concepts->firstWhere('header',Concept::AFP_SURE_PRIME);
        $commission = $concepts->firstWhere('header',Concept::AFP_COMISSION);
        $fifthCat= $concepts->firstWhere('header',Concept::FIFTH_CATEGORY);
        $collection = collect();
        $collection->push($contribution);
        $collection->push($sure);
        $collection->push($commission);
        $collection->push($fifthCat);
        return $collection;
    }

    public function listContribution(Collection $concepts): Collection
    {
        $contribution = $concepts->firstWhere('header',Concept::HEALTH);
        $collection = collect();
        $collection->push($contribution);
        return $collection;
    }

}
