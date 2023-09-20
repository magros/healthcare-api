<?php

use Illuminate\Database\Seeder;

class InsuranceCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Support\Facades\DB::table('insurers')->insert([
            ['name' => "Zurich"],
            ['name' => "Vitamédica"],
            ['name' => "Seguros Monterrey"],
            ['name' => "Seguros Atlas"],
            ['name' => "Publico en general"],
            ['name' => "Plan Seguro"],
            ['name' => "Panamerican"],
            ['name' => "Metropolitana Compañía de Seguros"],
            ['name' => "Met-Life"],
            ['name' => "Mapfre Seguros Tepeyac"],
            ['name' => "La Latinoamericana Seguros"],
            ['name' => "Interacciones"],
            ['name' => "ING"],
            ['name' => "Inbursa Inburmedic"],
            ['name' => "GNP Grupo Nacional Provincial"],
            ['name' => "BUPA"],
            ['name' => "Banorte - Generali"],
            ['name' => "AXXA"],
            ['name' => "Allianz"]
        ]);
    }
}
