<?php

use Illuminate\Database\Seeder;
use App\Settings;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $montlyGoal = 1300;
        $limboCoinsCourrentPrice = 30;

        Settings::create(array(
            'montly_goal' => $montlyGoal,
            'limbocoin_ars_price' => $limboCoinsCourrentPrice
        ));
    }
}
