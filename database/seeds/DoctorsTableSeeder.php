<?php

use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create(['id' => 1, 'name' => 'patient', 'slug' => 'patient']);
        \App\Role::create(['id' => 2, 'name' => 'doctor', 'slug' => 'doctor']);
    }
}
