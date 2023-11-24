<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = [
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Avansis Ltda.', 'company' => 'Vladimir Delic C y Cia Ltda.','rut' => '76096314-3'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Central de Carnes', 'company' => 'Central de Carnes Ltda','rut' => '77650460-2'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Arecheta', 'company' => 'Comercial Arecheta S.A','rut' => '96558780-2'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Arca Hogar', 'company' => 'Importadora Y Comercializadora Rio Serrano SPA','rut' => '77220124-9'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Cecinas Munchen', 'company' => 'Cecinas Munchen Ltda','rut' => '76849950-0'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Trasworld', 'company' => 'Transworld Supply Ltda','rut' => '77829700-0'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Sociedad Real', 'company' => 'Soc. Real Y Cia. Ltda','rut' => '76129350-8'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Emprenani', 'company' => 'Emprenani Ltda','rut' => '78795760-9'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Corcoran', 'company' => 'Corcoran Y Cia. SPA','rut' => '86527400-9'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'IMPA', 'company' => 'Ingeniería Mecánica, Proyectos y Asesorías, Limitada','rut' => '86676200-7'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Base Camp', 'company' => 'Campamento Base SPA','rut' => '76247309-7'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'MADEIN', 'company' => 'Comercial Fernardo Garcia E. I. R.L','rut' => '76411824-3'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Concrete Jungle', 'company' => 'Disenos Industriales Carolina Vukasovic Eirl','rut' => '76276671-K'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Pacifico Digital', 'company' => 'Importadora Y Comercial Pacifico Digital Spa','rut' => '76168842-1'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Ansilta', 'company' => 'Campamento SPA','rut' => '77121077-5'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Inversiones Best SPA', 'company' => 'Inversiones Best Spa','rut' => '77340697-9'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Wakool', 'company' => 'Wakool Duty Free Spa','rut' => '77487858-0'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Tienda ONE', 'company' => 'Margarita Vicente Poklepovic','rut' => '7860076-4'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'City Toys', 'company' => 'Inversiones City Play Spa','rut' => '76956891-3'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'La comarca del hobby', 'company' => 'Dante Ortiz Y Compañia Ltda','rut' => '77300385-8'],
            ['sistem' => 'AvanZF','status' => true, 'name' => 'Coyote Kids', 'company' => 'Importadora Y Comerc. Sofemi Spa','rut' => '76449587-K'],

        ];

        foreach ($organizations as $organization) {
            Organization::create($organization);
        }
    }
}
