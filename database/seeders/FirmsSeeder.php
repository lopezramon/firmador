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
            'sistem_app' => 'AvanZF',
            'id_xml' => '123TREO',
            'document_type' => 'Ingreso',
            ],
            ['organization_id' => 1,
            'sistem_app' => 'AvanZF',
            'id_xml' => '123TREO',
            'document_type' => 'Salida',
            ],
            ['organization_id' => 3,
            'sistem_app' => 'AvanZF',
            'id_xml' => '198KSDF',
            'document_type' => 'Salida',
            ],
            ['organization_id' => 7,
            'sistem_app' => 'AvanZF',
            'id_xml' => '4234LSDFK',
            'document_type' => 'Ingreso',
            ],
            ['organization_id' => 7,
            'sistem_app' => 'AvanZF',
            'id_xml' => '4234LSDFK',
            'document_type' => 'Modificación',
            ],
            ['organization_id' => 7,
            'sistem_app' => 'AvanZF',
            'id_xml' => '4234LSDFK',
            'document_type' => 'Salida',
            ],
            ['organization_id' => 6,
            'sistem_app' => 'AvanZF',
            'id_xml' => '765BMN',
            'document_type' => 'Ingreso',
            ]
        ];

        foreach ($firms as $firm) {
            Firm::create($firm);
        }
    }
}
