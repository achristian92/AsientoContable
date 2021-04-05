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
            'workArea'          => $collection->firstWhere('header',Concept::AREA)->value ?? '--',
            'position'          => $collection->firstWhere('header',Concept::POSITION)->value ?? '--',
            'withFamily'        => $collection->firstWhere('header',Concept::WITH_FAMILY)->value ? true : false,
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
        $concept = $concepts->firstWhere('header',Concept::NET);
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }

}
