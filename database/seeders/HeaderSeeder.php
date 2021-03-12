<?php

namespace Database\Seeders;

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
                'header' => 'Código',
                'is_required' => true
            ],
            [
                'header' => 'Trabajador',
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
                'header' => 'Area',
                'is_required' => false
            ],
            [
                'header' => 'Cod Cargo',
                'is_required' => false
            ],
            [
                'header' => 'Cargo',
                'is_required' => false
            ],
            [
                'header' => 'Fecha ingreso',
                'is_required' => true
            ],
            [
                'header' => 'Fecha cese',
                'is_required' => false
            ],
            [
                'header' => 'Nro identidad',
                'is_required' => true
            ],
            [
                'header' => 'Pension',
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
                'header' => 'Remuneración basica',
                'is_required' => true,
                'account_slug' => 'remuneracion_basica'
            ],
            [
                'header' => 'Asignación Familiar',
                'is_required' => 'true',
                'account_slug' => 'asignacion_familiar'
            ],
            [
                'header' => 'Total ingresos',
                'is_required' => true
            ],
            [
                'header' => 'AFP Aportación',
                'is_required' => true,
            ],
            [
                'header' => 'ONP',
                'is_required' => true,
                'account_slug' => 'onp',
            ],
            [
                'header' => 'AFP Seguro',
                'is_required' => true
            ],
            [
                'header' => 'AFP RA',
                'is_required' => true
            ],
            [
                'header' => '5ta. Categoria',
                'is_required' => true,
                'account_slug' => 'renta_de_5ta_categoria',
            ],
            [
                'header' => 'EPS',
                'is_required' => true,
                'account_slug' => 'eps_empleado',
            ],
            [
                'header' => 'Total Egresos',
                'is_required' => true
            ],
            [
                'header' => 'EsSalud',
                'is_required' => true,
                'account_slug' => 'essalud62',
            ],
            [
                'header' => 'EsSalud(P)',
                'is_required' => true,
                'show' => false,
                'account_slug' => 'essalud40',
            ],
            [
                'header' => 'Total Aportes',
                'is_required' => true
            ],
            [
                'header' => 'Neto',
                'is_required' => true,
                'account_slug' => 'sueldo',
            ],
        ]);
        $headers->each(function ($item,$key) {
            \DB::table('base_header')->insert([
                'header'       => $item['header'],
                'header_slug'  => Str::slug($item['header'],'_'),
                'order'        => $key * 10,
                'is_required'  => $item['is_required'],
                'account_slug' => $item['account_slug'] ?? '',
                'show'         => $item['show'] ?? true
            ]);
        });

    }
}
