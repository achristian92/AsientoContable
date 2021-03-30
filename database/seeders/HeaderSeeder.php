<?php

namespace Database\Seeders;

use App\AsientoContable\Concepts\Concept;
use Illuminate\Database\Seeder;
use Str;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $headers = collect([
            [
                'header' => Concept::CODE,
                'is_required' => true
            ],
            [
                'header' => Concept::FULL_NAME,
                'is_required' => true
            ],
            [
                'header' => 'Centro costo',
                'is_required' => true
            ],
            [
                'header' => 'Centro costo2',
                'is_required' => true
            ],
            [
                'header' => 'Cod Area',
                'is_required' => false
            ],
            [
                'header' => Concept::AREA,
                'is_required' => false
            ],
            [
                'header' => 'Cod Cargo',
                'is_required' => false
            ],
            [
                'header' => Concept::POSITION,
                'is_required' => false
            ],
            [
                'header' => Concept::DATE_ENTRY,
                'is_required' => true
            ],
            [
                'header' => 'Fecha cese',
                'is_required' => false
            ],
            [
                'header' => Concept::NRO_DOC,
                'is_required' => true
            ],
            [
                'header' => Concept::PENSION_SHORT,
                'is_required' => true
            ],
            [
                'header' => 'Moneda',
                'is_required' => true
            ],
            [
                'header' => 'Basico',
                'is_required' => false
            ],
            [
                'header' => 'Días trab',
                'is_required' => false
            ],
            [
                'header' => 'Horas trab',
                'is_required' => false
            ],
            [
                'header' => 'Horas extra',
                'is_required' => false
            ],
            [
                'header' => 'Min extra',
                'is_required' => false
            ],
            [
                'header' => 'Días PDT',
                'is_required' => false
            ],
            [
                'header' => 'Base imponible',
                'is_required' => false
            ],
            [
                'header' => Concept::BASIC_SALARY,
                'is_required' => true,
                'has_account' => true
            ],
            [
                'header' => Concept::WITH_FAMILY,
                'is_required' => 'true',
                'has_account' => true
            ],
            [
                'header' => Concept::TOTAL_INCOME,
                'is_required' => true
            ],
            [
                'header' => Concept::AFP_CONTRIBUTION,
                'is_required' => true,
            ],
            [
                'header' => Concept::ONP,
                'is_required' => true,
                'has_account' => true
            ],
            [
                'header' => Concept::AFP_SURE_PRIME,
                'is_required' => true
            ],
            [
                'header' => Concept::AFP_COMISSION,
                'is_required' => true
            ],
            [
                'header' => Concept::FIFTH_CATEGORY,
                'is_required' => true,
                'has_account' => true
            ],
            [
                'header' => 'EPS',
                'is_required' => true,
                'has_account' => true
            ],
            [
                'header' => Concept::TOTAL_DISCOUNT,
                'is_required' => true
            ],
            [
                'header' => Concept::HEALTH,
                'is_required' => true,
                'has_account' => true
            ],
            [
                'header' => 'EsSalud(P)',
                'is_required' => true,
                'has_account' => true
            ],
            [
                'header' => Concept::TOTAL_CONTRIBUTION,
                'is_required' => true
            ],
            [
                'header' => Concept::NET,
                'is_required' => true,
                'has_account' => true
            ],
        ]);
        $headers->each(function ($item,$key) {
            \DB::table('base_header')->insert([
                'header'       => $item['header'],
                'header_slug'  => slug($item['header']),
                'order'        => $key * 10,
                'is_required'  => $item['is_required'],
                'has_account'  => $item['has_account'] ?? false,
            ]);
        });

    }
}
