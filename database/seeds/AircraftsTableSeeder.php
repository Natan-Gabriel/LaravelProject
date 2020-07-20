<?php

use Illuminate\Database\Seeder;

class AircraftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Aircraft::class, 5)->create();
    }
}
