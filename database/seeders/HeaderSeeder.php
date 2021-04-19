<?php

namespace Database\Seeders;

use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Headers\Header;
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
        $baseHeaders = collect([
            [
                'name' => Concept::CODE,
                'is_required' => true
            ],
            [
                'name' => Concept::FULL_NAME,
                'is_required' => true
            ],
            [
                'name' => Concept::COSTCENTER,
                'is_required' => true
            ],
            [
                'name' => Concept::COSTCENTER2,
                'is_required' => true
            ],
            [
                'name' => 'Cod Area',
                'is_required' => false
            ],
            [
                'name' => Concept::AREA,
                'is_required' => false
            ],
            [
                'name' => 'Cod Cargo',
                'is_required' => false
            ],
            [
                'name' => Concept::POSITION,
                'is_required' => false
            ],
            [
                'name' => Concept::DATE_ENTRY,
                'is_required' => true
            ],
            [
                'name' => Concept::DATE_TERMINATION,
                'is_required' => false
            ],
            [
                'name' => Concept::NRO_DOC,
                'is_required' => true
            ],
            [
                'name' => Concept::PENSION_SHORT,
                'is_required' => true
            ],
            [
                'name' => 'Moneda',
                'is_required' => true
            ],
            [
                'name' => 'Basico',
                'is_required' => false
            ],
            [
                'name' => Concept::WORKED_DAYS,
                'is_required' => false
            ],
            [
                'name' => Concept::LCGH,
                'is_required' => false,
                'is_active' => false,
            ],
            [
                'name' => Concept::WORKED_NOT_DAYS,
                'is_required' => false
            ],
            [
                'name' => Concept::VACATION_DAYS,
                'is_required' => false,
                'is_active' => false,
            ],
            [
                'name' => Concept::WORKED_HOURS,
                'is_required' => false
            ],
            [
                'name' => Concept::HOURS_EXT25,
                'is_required' => false,
                'is_active' => false,
            ],
            [
                'name' => Concept::HOURS_EXT35,
                'is_required' => false,
                'is_active' => false,
            ],
            [
                'name' => 'Horas extra',
                'is_required' => false
            ],
            [
                'name' => 'Min extra',
                'is_required' => false
            ],
            [
                'name' => 'Días PDT',
                'is_required' => false
            ],
            [
                'name' => 'Base imponible',
                'is_required' => false
            ],
            [
                'name'      => Concept::BASIC_SALARY,
                'is_required' => true,
                'has_account' => true,
                'type'        => Header::TYPE_INCOME
            ],
            [
                'name'      => Concept::WITH_FAMILY,
                'is_required' => 'true',
                'has_account' => true,
                'type'        => Header::TYPE_INCOME
            ],
            [
                'name' => Concept::TOTAL_INCOME,
                'is_required' => true
            ],
            [
                'name' => Concept::AFP_CONTRIBUTION,
                'is_required' => true,
                'type'        => Header::TYPE_EXPENSE
            ],
            [
                'name' => Concept::ONP,
                'is_required' => true,
                'has_account' => true,
                'type'        => Header::TYPE_EXPENSE
            ],
            [
                'name' => Concept::AFP_SURE_PRIME,
                'is_required' => true,
                'type'        => Header::TYPE_EXPENSE
            ],
            [
                'name' => Concept::AFP_COMISSION,
                'is_required' => true,
                'type'        => Header::TYPE_EXPENSE
            ],
            [
                'name' => Concept::FIFTH_CATEGORY,
                'is_required' => true,
                'has_account' => true,
                'type'        => Header::TYPE_EXPENSE
            ],
            [
                'name' => 'EPS',
                'is_required' => true,
                'has_account' => true,
                'type'        => Header::TYPE_EXPENSE
            ],
            [
                'name' => Concept::TOTAL_DISCOUNT,
                'is_required' => true
            ],
            [
                'name' => Concept::HEALTH,
                'is_required' => true,
                'has_account' => true,
                'type'        => Header::TYPE_CONTRIBUTION
            ],
            [
                'name' => 'EsSalud(P)',
                'is_required' => true,
                'has_account' => true
            ],
            [
                'name' => Concept::TOTAL_CONTRIBUTION,
                'is_required' => true
            ],
            [
                'name' => Concept::NET,
                'is_required' => true,
                'has_account' => true
            ],
        ]);
        $baseHeaders->each(function ($item,$key) {
            \DB::table('base_header')->insert([
                'name'        => $item['name'],
                'slug'        => slug($item['name']),
                'type'        => $item['type'],
                'order'       => $key * 10,
                'is_required' => $item['is_required'],
                'has_account' => $item['has_account'] ?? false,
                'is_account_main' => (bool)$item['has_account'],
                'is_active'   => isset($item['is_active']) ? $item['is_active'] : true,
            ]);
        });

    }
}
