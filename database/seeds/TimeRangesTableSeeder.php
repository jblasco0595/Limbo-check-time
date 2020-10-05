<?php

use Illuminate\Database\Seeder;

class TimeRangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TimeRange::class, 100)->create();
    }
}
