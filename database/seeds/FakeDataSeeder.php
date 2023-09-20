<?php

use Illuminate\Database\Seeder;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = \App\Models\State::all();

        $faker = \Faker\Factory::create();

        foreach ($states as $state) {
            $this->command->info('State: ' . $state->name);

            $doctors = factory(\App\Models\Doctor::class, 3)->create();
            foreach ($doctors as $doctor) {
                $doctor->opinions()->create([
                    'patient_id' => \App\Models\Patient::inRandomOrder()->first()->id,
                    'commentaries' => $faker->sentence,
                    'rate' => rand(1, 5)
                ]);
                $office = factory(\App\Models\Office::class)->create(['state_id' => $state->id, 'doctor_id' => $doctor->id]);
                $doctor->specialities()->attach(\App\Models\Speciality::inRandomOrder()->first()->id);
                $doctor->medicalServices()->attach(1, ['cost' => 500, 'duration' => 30]);
                $doctor->medicalServices()->attach(2, ['cost' => 100, 'duration' => 60]);

                $office->schedule()->create(['weekday' => 1, 'start_hour' => '08:00', 'end_hour' => '15:00']);
                $office->schedule()->create(['weekday' => 2, 'start_hour' => '08:00', 'end_hour' => '15:00']);
                $office->schedule()->create(['weekday' => 3, 'start_hour' => '08:00', 'end_hour' => '15:00']);
                $office->schedule()->create(['weekday' => 4, 'start_hour' => '08:00', 'end_hour' => '15:00']);
                $office->schedule()->create(['weekday' => 5, 'start_hour' => '08:00', 'end_hour' => '15:00']);
                $office->schedule()->create(['weekday' => 6, 'start_hour' => '08:00', 'end_hour' => '15:00']);
                $office->schedule()->create(['weekday' => 7, 'start_hour' => '08:00', 'end_hour' => '15:00']);
            }
        }
    }
}
