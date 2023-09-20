<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'email'=>'iron-rocks@hotmail.com',
            'name'=>'Marco Godinez',
            'password'=> \Illuminate\Support\Facades\Hash::make('secret'),
            'api_token' => \Illuminate\Support\Str::random()
        ]);
        $user->roles()->attach([1,2]);
        $user->patient()->create();
        $user = \App\User::create([
            'email'=>'iannus12@gmail.com',
            'name'=>'Juan Pablo Corona',
            'password'=> \Illuminate\Support\Facades\Hash::make('secret'),
            'api_token' => \Illuminate\Support\Str::random()
        ]);
        $user->roles()->attach([1,2]);
        $user->patient()->create();
        $user = \App\User::create([
            'email'=>'cpolo@test.com',
            'name'=>'Carlos Polo',
            'password'=> \Illuminate\Support\Facades\Hash::make('secret'),
            'api_token' => \Illuminate\Support\Str::random()
        ]);
        $user->patient()->create();
        $user->roles()->attach([1]);
    }
}
