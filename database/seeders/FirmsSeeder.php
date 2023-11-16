<?php

namespace Database\Seeders;

use App\Models\Firm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FirmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firms = [
            ['organization_id' => 1,
            'id_xml' => '123TREO',
            'document_type' => 'Ingreso',
            'date_time' => date('Y-m-d H:i:s')],
            ['organization_id' => 1,
            'id_xml' => '123TREO',
            'document_type' => 'Salida',
            'date_time' => date('Y-m-d H:i:s')],
            ['organization_id' => 3,
            'id_xml' => '198KSDF',
            'document_type' => 'Salida',
            'date_time' => date('Y-m-d H:i:s')],
            ['organization_id' => 7,
            'id_xml' => '4234LSDFK',
            'document_type' => 'Ingreso',
            'date_time' => date('Y-m-d H:i:s')],
            ['organization_id' => 7,
            'id_xml' => '4234LSDFK',
            'document_type' => 'Modificación',
            'date_time' => date('Y-m-d H:i:s')],
            ['organization_id' => 7,
            'id_xml' => '4234LSDFK',
            'document_type' => 'Salida',
            'date_time' => date('Y-m-d H:i:s')],
            ['organization_id' => 6,
            'id_xml' => '765BMN',
            'document_type' => 'Ingreso',
            'date_time' => date('Y-m-d H:i:s')]
        ];

        foreach ($firms as $firm) {
            Firm::create($firm);
        }
    }
}
