<?php

use Illuminate\Database\Seeder;

class MedicalServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('medical_services')->insert([
            ['id' => 1,'name' => "Cirugía"],
            ['id' => 2, 'name' => "Consulta General"],
        ]);
    }
}
