<?php


namespace App\AsientoContable\Concepts\Repositories;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Concepts\Transformations\ConceptTrait;
use App\AsientoContable\HeaderAccountingsAccount\HeaderAccount;
use App\AsientoContable\PensionFund\PensionFund;
use App\AsientoContable\PensionFund\PensionTrait;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class ConceptRepo extends BaseRepository implements IConcept
{
    use ConceptTrait, PensionTrait;

    public function model()
    {
        return Concept::class;
    }

    public function showConceptCollaboratorList(int $file_id): array
    {
        $collaboratorIDS = $this->model::where('file_id',$file_id)->get()->pluck('collaborator_id')->unique();
        $pensionsFund = PensionFund::all();
        $conceptsConcepts = $this->model::whereIn('collaborator_id',$collaboratorIDS)
                                    ->where('file_id',$file_id)
                                    ->get()
                                    ->groupBy('collaborator_id');

        return $conceptsConcepts->map(function ($collaboratorConcept) use ($pensionsFund) {
            return $lists[] = $this->generalConceptCollaborator($collaboratorConcept,$pensionsFund);
        })->toArray();
    }

    public function detailConceptCollaborator(int $file_id, int $collaborator_id)
    {
        $collection = $this->model::where(['file_id'=> $file_id,'collaborator_id'=> $collaborator_id])->get();

        $accounts = $this->buildAccountingAccount($collection);

        return [
            'info'      => $this->basicInfo($collection),
            'costs'     => $this->basicCosts($collection),
            'concepts'  => $collection,
            'accounts'  => $accounts,
            'totalMust' => number_format($accounts->where('type','debits')->sum('value'),2),
            'totalHas'  => number_format($accounts->where('type','credits')->sum('value'),2)
        ];
    }

    private function buildAccountingAccount($collection)
    {
        $headers = AccountHeader::where(['customer_id' => customerID(),'show' => true])->get()->whereNotIn('account_slug','');

        $accounts = $headers->map(function ($item) use ($collection) {
            $data = $collection->firstWhere('header_slug',$item['name_slug']);
            $account_slug = AccountHeader::firstWhere('name_slug',$item['name_slug'])->account_slug ?? '';
            $accountPlan = AccountPlan::firstWhere('import_slug',$account_slug) ?? '';
            return [
                'concept'     => $data->header,
                'cta'         => $accountPlan->code ?? '',
                'description' => $accountPlan->name ?? '',
                'type'        => HeaderAccount::firstWhere('slug',$accountPlan->import_slug)->type ?? '',
                'value'       => empty($data->value) ? null : $data->value
            ];
        })->values();

        $accountpension = $this->buildAccountPension($collection);
        $pensionHealth = $this->buildAccountHealthPasive($collection);
        $accounts = $accounts->push($accountpension);
        $accounts = $accounts->push($pensionHealth);

        return $accounts->whereNotNull('value');
    }
    private function buildAccountPension(Collection $collection)
    {
        $concept = $collection->firstWhere('header_slug','pension');
        $account = $this->searchAccountPlanPension($concept['value']);
        return [
            'concept'     => 'Pension',
            'cta'         => $account->code ?? '',
            'description' => $account->name ?? '',
            'type'        => HeaderAccount::firstWhere('slug',$account->import_slug)->type,
            'value'       => strtoupper($concept['value']) !== 'ON' ? $this->totalPensionAFP($collection) : null,
        ];
    }
    private function buildAccountHealthPasive(Collection $collection): array
    {
        $account = AccountPlan::firstWhere('import_slug','essalud40');
        return [
            'concept'     => 'EsSalud',
            'cta'         => $account->code,
            'description' => $account->name,
            'type'        => HeaderAccount::firstWhere('slug',$account->import_slug)->type,
            'value'       => $collection->firstWhere('header_slug','essalud')->value,
        ];
    }

    private function searchAccountPlanPension($nameSlug): AccountPlan
    {
        $pensionSlug = $this->searchPensionSlug($nameSlug);
        return AccountPlan::firstWhere('import_slug',$pensionSlug);
    }

    public function totalPensionAFP(Collection $collection)
    {
        $hasOnp = $this->hasPensionONP($collection);
        if ($hasOnp)
            return $collection->firstWhere('header_slug','onp')->value;

        $afp = $collection->firstWhere('header_slug','afp_aportacion')->value;
        $insurance = $collection->firstWhere('header_slug','afp_seguro')->value;
        $ra = $collection->firstWhere('header_slug','afp_ra')->value;
        return $afp + $insurance + $ra;
    }


}
