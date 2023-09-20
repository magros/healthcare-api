<?php

use Illuminate\Database\Seeder;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('hospitals')->insert([
            ['name' => 'STAR MEDICA'],
            ['name' => 'SAN JOSÉ']
        ]);

    }
}
