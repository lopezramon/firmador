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

        activity()->withoutLogs(function () {
            $this->call([
                PermissionsSeeder::class,
                // ModulesSeeder::class,
            ]);
        });
        \App\Models\Organization::factory(10)->create();
        \App\Models\Firm::factory(10)->create();
        \App\Models\LogSignatur::factory(10)->create();
    }
}