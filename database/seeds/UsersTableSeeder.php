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
            'password' => Hash::make('password')
        ));

        User::create(array(
            'name' => 'anniel',
            'email' => 'anniel@gmail.com',
            'password' => Hash::make('password')
        ));

        User::create(array(
            'name' => 'gabriel',
            'email' => 'gabriel@gmail.com',
            'password' => Hash::make('password')
        ));
        
        factory(User::class, 260)->create();
    }
}
