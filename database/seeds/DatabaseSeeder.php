<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('RolesTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('SpecialitiesTableSeeder');
        $this->call('InsuranceCompaniesSeeder');
        $this->call('StatesTableSeeder');
        $this->call('HospitalsTableSeeder');
        $this->call('MedicalServicesTableSeeder');
        //$this->call('FakeDataSeeder');
    }
}
