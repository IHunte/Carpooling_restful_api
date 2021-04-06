<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VoyageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Voyage::factory(10)->create();
    }
}
