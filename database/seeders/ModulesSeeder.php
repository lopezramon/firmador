<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modulos = [
            ['nombre' => 'Organization',  'slug' => 'agentes'],
            ['nombre' => 'Firm',          'slug' => 'contratos'],
            ['nombre' => 'Log Signature', 'slug' => 'carreras'],
        ];

        foreach ($modulos as $modulo) {
            Module::create($modulo);
        }
    }
}
