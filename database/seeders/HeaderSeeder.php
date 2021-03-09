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
            'Remuneración Básica(G)',
            'Asignación Familiar(G)',
            'EPS Empleado(G)',
            'Renta de 5ta. Categoría(P)',
            'EsSalud(P)',
            'EsSalud(G)',
            'O.N.P(P)',
            'Sueldo(P)'
        ]);
        $headers->each(function ($item) {
           \DB::table('headers')->insert([
               'name' => $item,
               'name_slug' => Str::slug($item,'_')
           ]);
        });
    }
}
