<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\User;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make('secret'),
        'api_token' => Str::random()
    ];
});
$factory->define(Patient::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
    ];
});

$factory->define(Doctor::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'professional_license' => $faker->uuid,
        'experience_summary' => $faker->realText(500),
        'academic_info' => $faker->randomElement([
            'Medico cirujano - UVM',
            'Medico general - UAQ',
            'Medico cirujano - UNAM'
        ]),
        'other_academic_info' => $faker->realText(100),
        'professional_activities' => $faker->sentence,
        'societies' => $faker->sentence,
        'awards' => $faker->sentence,
        'other_activities' => $faker->realText(100)
    ];
});

$factory->define(Hospital::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});


$factory->define(\App\Models\Office::class, function (Faker\Generator $faker) {

    $y0 = 20.588056;
    $x0 = -100.388056;
    $rd = 20000 / 111300;

    $u = mt_rand() / mt_getrandmax();
    $v = mt_rand() / mt_getrandmax();

    $w = $rd * sqrt($u);
    $t = 2 * 3.1416 * $v;
    $x = $w * cos($t);
    $y = $w * sin($t);

    $latitude = $y + $y0;
    $longitude = $x + $x0;


    return [
        'doctor_id' => factory(Doctor::class)->create()->id,
        'description' => $faker->company,
        'address' => $faker->address,
        'postal_code' => 76000,
        'suburb' => 'San José de Los olvera',
        'city' => 'Querétaro',
        'address_reference' => 'Zahuán negro',
        'contact_phone' => '541321321',
        'latitude' => $latitude,
        'longitude' => $longitude,
        'state_id' => rand(1, 20)
    ];
});
