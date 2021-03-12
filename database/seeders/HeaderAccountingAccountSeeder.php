<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Str;

class HeaderAccountingAccountSeeder extends Seeder
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
                'name' => 'Remuneración Basica',
                'type' => 'debits'
            ],
            [
                'name' => 'Asignación Familiar',
                'type' => 'debits'
            ],
            [
                'name' => 'Ingreso H.E. 25%',
                'type' => 'debits'
            ],
            [
                'name' => 'Ingreso H.E. 35%',
                'type' => 'debits'
            ],
            [
                'name' => 'Gratificaciones Truncas',
                'type' => 'debits'
            ],
            [
                'name' => 'Bonif.Extraor.LEY 30334',
                'type' => 'debits'
            ],
            [
                'name' => 'Remuneración CTS',
                'type' => 'debits'
            ],
            [
                'name' => 'Vacaciones Truncas',
                'type' => 'debits'
            ],
            [
                'name' => 'Vacaciones Vendidas',
                'type' => 'debits'
            ],
            [
                'name' => 'Remuneración Vacacional',
                'type' => 'debits'
            ],
            [
                'name' => 'Bonificación',
                'type' => 'debits'
            ],
            [
                'name' => 'Condicion de Trabajo',
                'type' => 'debits'
            ],
            [
                'name' => 'Descanso Medico',
                'type' => 'debits'
            ],
            [
                'name' => 'Reintegro Afecto/Asig. Fam',
                'type' => 'debits'
            ],
            [
                'name' => 'EsSalud(62)',
                'type' => 'debits'
            ],
            [
                'name' => 'IN - AFP INTEGRA',
                'type' => 'credits'
            ],
            [
                'name' => 'PR - AFP PROFUTURO',
                'type' => 'credits'
            ],
            [
                'name' => 'HA - AFP HABITAT',
                'type' => 'credits'
            ],
            [
                'name' => 'IN - AFP INTEGRA',
                'type' => 'credits'
            ],
            [
                'name' => 'PM - AFP PRIMA',
                'type' => 'credits'
            ],
            [
                'name' => 'O.N.P.',
                'type' => 'credits'
            ],
            [
                'name' => 'Adelanto de Sueldo',
                'type' => 'credits'
            ],
            [
                'name' => 'Otros Descuentos/Condicion Trab.',
                'type' => 'credits'
            ],
            [
                'name' => 'Renta de 5ta. Categoría',
                'type' => 'credits'
            ],
            [
                'name' => 'EPS Empleado',
                'type' => 'credits'
            ],
            [
                'name' => 'EsSalud(40)',
                'type' => 'credits'
            ],
            [
                'name' => 'Sueldo',
                'type' => 'credits'
            ]
        ]);
        $headers->each(function ($item) {
            \DB::table('header_accounting_account')->insert([
                'name' => $item['name'],
                'slug' => Str::slug($item['name'],'_'),
                'type' => $item['type'],
            ]);
        });
    }
}
