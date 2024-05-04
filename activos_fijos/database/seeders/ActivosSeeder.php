<?php

namespace Database\Seeders;

use App\Models\Activo;
use Illuminate\Database\Seeder;

class ActivosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activo::create([
            'name' => 'Computadora',
            'code' => 'CM001',
            'description' => 'Computadora de escritorio',
            'initial_amount' => 10,
        ]);

        Activo::create([
            'name' => 'Impresora',
            'code' => 'CM002',
            'description' => 'Impresora láser a color',
            'initial_amount' => 5,
        ]);

        Activo::create([
            'name' => 'Teléfono',
            'code' => 'CM003',
            'description' => 'Teléfono inteligente',
            'initial_amount' => 20,
        ]);
    }
}
