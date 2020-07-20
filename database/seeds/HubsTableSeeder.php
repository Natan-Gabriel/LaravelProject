<?php

use Illuminate\Database\Seeder;

class HubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Hub::class, 5)->create();
    }
}
