<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('states')->insert([
            [
                "id" => 1,
                "name" => "Distrito Federal",
                "code" => "MX-DIF",
            ],
            [
                "id" => 2,
                "name" => "Estado de México",
                "code" => "MX-EDO",
            ],
            [
                "id" => 3,
                "name" => "Aguascalientes",
                "code" => "MX-AGU",
            ],
            [
                "id" => 4,
                "name" => "Baja California",
                "code" => "MX-BCN",
            ],
            [
                "id" => 5,
                "name" => "Baja California Sur",
                "code" => "MX-BCS",
            ],
            [
                "id" => 6,
                "name" => "Campeche",
                "code" => "MX-CAM",
            ],
            [
                "id" => 7,
                "name" => "Chiapas",
                "code" => "MX-CHP",
            ],
            [
                "id" => 8,
                "name" => "Chihuahua",
                "code" => "MX-CHH",
            ],
            [
                "id" => 9,
                "name" => "Coahuila",
                "code" => "MX-COA",
            ],
            [
                "id" => 10,
                "name" => "Colima",
                "code" => "MX-COL",
            ],
            [
                "id" => 11,
                "name" => "Durango",
                "code" => "MX-DUR",
            ],
            [
                "id" => 12,
                "name" => "Guanajuato",
                "code" => "MX-GUA",
            ],
            [
                "id" => 13,
                "name" => "Guerrero",
                "code" => "MX-GRO",
            ],
            [
                "id" => 14,
                "name" => "Hidalgo",
                "code" => "MX-HID",
            ],
            [
                "id" => 15,
                "name" => "Jalisco",
                "code" => "MX-JAL",
            ],
            [
                "id" => 16,
                "name" => "Michoacán",
                "code" => "MX-MIC",
            ],
            [
                "id" => 17,
                "name" => "Morelos",
                "code" => "MX-MOR",
            ],
            [
                "id" => 18,
                "name" => "México",
                "code" => "MX-MEX",
            ],
            [
                "id" => 19,
                "name" => "Nayarit",
                "code" => "MX-NAY",
            ],
            [
                "id" => 20,
                "name" => "Nuevo León",
                "code" => "MX-NLE",
            ],
            [
                "id" => 21,
                "name" => "Oaxaca",
                "code" => "MX-OAX",
            ],
            [
                "id" => 22,
                "name" => "Puebla",
                "code" => "MX-PUE",
            ],
            [
                "id" => 23,
                "name" => "Querétaro",
                "code" => "MX-QUE",
            ],
            [
                "id" => 24,
                "name" => "Quintana Roo",
                "code" => "MX-ROO",
            ],
            [
                "id" => 25,
                "name" => "San Luis Potosí",
                "code" => "MX-SLP",
            ],
            [
                "id" => 26,
                "name" => "Sinaloa",
                "code" => "MX-SIN",
            ],
            [
                "id" => 27,
                "name" => "Sonora",
                "code" => "MX-SON",
            ],
            [
                "id" => 28,
                "name" => "Tabasco",
                "code" => "MX-TAB",
            ],
            [
                "id" => 29,
                "name" => "Tamaulipas",
                "code" => "MX-TAM",
            ],
            [
                "id" => 30,
                "name" => "Tlaxcala",
                "code" => "MX-TLA",
            ],
            [
                "id" => 31,
                "name" => "Veracruz",
                "code" => "MX-VER",
            ],
            [
                "id" => 32,
                "name" => "Yucatán",
                "code" => "MX-YUC",
            ],
            [
                "id" => 33,
                "name" => "Zacatecas",
                "code" => "MX-ZAC",
            ],
        ]);

    }
}
