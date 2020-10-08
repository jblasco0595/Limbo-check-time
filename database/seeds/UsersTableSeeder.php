<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'name' => 'jorge',
            'email' => 'jorge@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('1234'),
            'username' => 'jblasco',
            'limbocoins' => 15
        ));

        User::create(array(
            'name' => 'anniel',
            'email' => 'anniel@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('1234'),
            'username' => 'aLuna',
            'limbocoins' => 15
        ));

        User::create(array(
            'name' => 'gabriel',
            'email' => 'gabriel@gmail.com',
            'role' => 'employee',
            'password' => Hash::make('1234'),
            'username' => 'gguerrero',
            'limbocoins' => 15
        ));
        
        factory(User::class, 260)->create();
    }
}
