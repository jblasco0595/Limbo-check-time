<?php

use App\ExtraTime;
use Illuminate\Database\Seeder;

class ExtraTimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ExtraTime::class, 50)->create();
    }
}
