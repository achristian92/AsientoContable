<?php


namespace App\AsientoContable\Concepts\Transformations;


use Illuminate\Support\Collection;

trait ConceptTrait
{
    public function generalConceptCollaborator(Collection $collection, Collection $pensionFunds): array
    {
        return [
            'collaborator_id'   => $collection->first()->collaborator_id,
            'file_id'           => $collection->first()->file_id,
            'employee'          => $collection->firstWhere('header_slug','trabajador')->value,
            'workArea'          => $collection->firstWhere('header_slug','area')->value,
            'position'          => $collection->firstWhere('header_slug','cargo')->value,
            'withFamily'        => $collection->firstWhere('header_slug','asignacion_familiar')->value ? true : false,
            'pension'           => $this->searchPensionName($collection,$pensionFunds),
            'totalIncome'       => $this->totalIncome($collection),
            'totalExpense'      => $this->totalExpense($collection),
            'totalContribution' => $this->totalContribution($collection),
            'netToPay'          => $this->netToPay($collection),
        ];
    }



    public function basicInfo(Collection $concepts): array
    {
        return [
            'file_id'      => $concepts->first()->file_id,
            'customer_id'  => $concepts->first()->customer_id,
            'payrollMonth' => 'Planilla '.$concepts->first()->file->name,
            'worker'       => $concepts->firstWhere('header_slug','trabajador')->value,
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
        $concept = $concepts->firstWhere('header_slug','remuneracion_basica');
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }
    public function totalIncome(Collection $concepts): float
    {
        $concept = $concepts->firstWhere('header_slug','total_ingresos');
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }
    public function totalExpense(Collection $concepts): float
    {
        $concept = $concepts->firstWhere('header_slug','total_egresos');
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }
    public function totalContribution(Collection $concepts): float
    {
        $concept = $concepts->firstWhere('header_slug','total_aportes');
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }
    public function netToPay(Collection $concepts): float
    {
        $concept = $concepts->firstWhere('header_slug','neto');
        if (is_numeric($concept->value))
            return $concept->value;
        return 0;
    }

}
