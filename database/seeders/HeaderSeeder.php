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
                'name' => Concept::COSTNAME,
                'is_required' => true
            ],
            [
                'name' => Concept::CODAREA,
                'is_required' => false
            ],
            [
                'name' => Concept::NAMEAREA,
                'is_required' => false
            ],
            [
                'name' => Concept::CODCARGO,
                'is_required' => false
            ],
            [
                'name' => Concept::NAMECARGO,
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
                'name' => Concept::CURRENCY,
                'is_required' => true
            ],
            [
                'name' => Concept::BASIC,
                'is_required' => false
            ],
            [
                'name' => Concept::DAYFERIADO,
                'is_required' => false
            ],
            [
                'name' => Concept::WORKED_DAYS,
                'is_required' => false
            ],
            [
                'name' => Concept::TDSUB,
                'is_required' => false
            ],
            [
                'name' => Concept::TDNOTSUB,
                'is_required' => false
            ],
            [
                'name' => Concept::HOURS_EXT25,
                'is_required' => false
            ],
            [
                'name' => Concept::WORKED_HOURS,
                'is_required' => false
            ],
            [
                'name' => Concept::HOURS_EXT35,
                'is_required' => false
            ],
            [
                'name' => Concept::MEDICAL_REST,
                'is_required' => false
            ],
            [
                'name' => Concept::DAYSLV,
                'is_required' => false
            ],
            [
                'name' => Concept::HE100,
                'is_required' => false
            ],
            [
                'name' => Concept::WORKED_NOT_DAYS,
                'is_required' => false
            ],
            [
                'name' => Concept::BASEIMPONIBLE,
                'is_required' => false
            ],

            [
                'name' => Concept::LCGH,
                'is_required' => false,
            ],
            [
                'name' => Concept::LSINGH,
                'is_required' => false,
            ],
            [
                'name' => Concept::DAYSSUBEMF,
                'is_required' => false,
            ],
            [
                'name' => Concept::DAYSSUBMAT,
                'is_required' => false,
            ],
            [
                'name' => Concept::VACATION_DAYS,
                'is_required' => false,
            ],
            [
                'name' => Concept::VACATION_DAYS_VENC,
                'is_required' => false,
            ],

            //Azul
            [
                'name'      => Concept::BASIC_SALARY,
                'is_required' => true,
                'has_account' => true,
                'type'        => Header::TYPE_INCOME
            ],
            [
                'name'      => Concept::OVERDUE_VACATION,
                'is_required' => false,
                'has_account' => true,
            ],
            [
                'name'      => Concept::WITH_FAMILY,
                'is_required' => 'true',
                'has_account' => true,
                'type'        => Header::TYPE_INCOME
            ],
            [
                'name' => Concept::INGHE25,
                'has_account' => true,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGHE35,
                'has_account' => true,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGFERIADO,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGSUBENF,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGSUBMAT,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGHE100,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGMOV,
                'is_required' => false,
            ],
            [
                'name' => Concept::EXTRA_BONUS,
                'has_account' => true,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGCOMI,
                'is_required' => false,
            ],
            [
                'name' => Concept::VACATION_PAY,
                'has_account' => true,
                'is_required' => false,
            ],
            [
                'name' => Concept::CTS,
                'has_account' => true,
                'is_required' => false,
            ],
            [
                'name' => Concept::TRUNCATED_VACATION,
                'has_account' => true,
                'is_required' => false,
            ],
            [
                'name' => Concept::TRUNCATED_GRATUITIES,
                'has_account' => true,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGLCH,
                'is_required' => false,
            ],
            [
                'name' => Concept::BONUS,
                'has_account' => true,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGREINA,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGBONPROD,
                'is_required' => false,
            ],
            [
                'name' => Concept::INGOTRAFC,
                'is_required' => false,
            ],
            [
                'name' => Concept::AFFECTIVE_REFUND,
                'has_account' => true,
                'is_required' => false,
            ],

            [
                'name' => Concept::TOTAL_INCOME,
                'is_required' => true
            ],

            // ROJO
            [
                'name' => Concept::ONP,
                'is_required' => true,
                'has_account' => true,
                'type'        => Header::TYPE_EXPENSE
            ],
            [
                'name' => Concept::AFP_CONTRIBUTION,
                'is_required' => true,
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
                'name' => Concept::INASIS,
            ],
            [
                'name' => Concept::ADPAGO,
            ],
            [
                'name' => Concept::PRESTAMOS,
            ],
            [
                'name' => Concept::FIFTH_CATEGORY,
                'is_required' => true,
                'has_account' => true,
                'type'        => Header::TYPE_EXPENSE
            ],
            [
                'name' => Concept::EGREADLVAC,
            ],
            [
                'name' => Concept::EGREADQUIN,
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
                'name' => Concept::HELTHPASIVO,
                'is_required' => true,
                'has_account' => true,
            ],

            [
                'name' => Concept::TOTAL_CONTRIBUTION,
                'is_required' => true
            ],

            [
                'name' => Concept::NETO,
                'is_required' => true,
                'has_account' => true
            ],
        ]);
        $baseHeaders->each(function ($item,$key) {
            \DB::table('base_header')->insert([
                'name'        => $item['name'],
                'slug'        => slug($item['name']),
                'type'        => $item['type'] ?? '',
                'order'       => $key * 10,
                'is_required' => $item['is_required'] ?? false,
                'has_account' => $item['has_account'] ?? false,
                'is_account_main' => (bool)$item['has_account'],
                'is_active'   => $item['is_active'] ?? true,
            ]);
        });

    }
}
