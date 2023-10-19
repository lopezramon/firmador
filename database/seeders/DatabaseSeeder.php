<?php

namespace Database\Seeders;

use App\Models\TipoContrato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Profesion::factory(10)->create();
        \App\Models\Titulo::factory(10)->create();
        \App\Models\VinculacionLaboral::factory(10)->create();
        \App\Models\AsistenciaTipoContrato::factory(10)->create();
        \App\Models\Grupo::factory(10)->create();
        \App\Models\Funcion::factory(5)->create();
        \App\Models\TipoLiquidacion::factory(5)->create();
        \App\Models\TipoNormativa::factory(5)->create();
        activity()->withoutLogs(function () {
            $this->call([
                PermissionsSeeder::class,
                ModulesSeeder::class,
                PuestosSeeder::class,
                TipoContratosSeeder::class,
                TipoTramitesSeeder::class,
                TipoServiciosMedicosSeeder::class,
                TipoCertificadosMedicosSeeder::class,
                TipoOpcionesArticulosSeeder::class,
                TipoMaternidadCertificadosSeeder::class,
                TipoEnfermedadesSeeder::class
            ]);
        });
        // \App\Models\Carrera::factory(100)->create();
        // \App\Models\Contrato::factory(5)->create();
        // \App\Models\PlantaPermanente::factory(100)->create();
        // \App\Models\Asistencia::factory(5)->create();
        // \App\Models\Evaluacion::factory(5)->create();
        // \App\Models\AsistenciaMedica::factory(5)->create();
        // \App\Models\Legajo::factory(5)->create();
        \App\Models\Liquidacion::factory(5)->create();
    }
}