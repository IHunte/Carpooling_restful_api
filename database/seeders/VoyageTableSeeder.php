<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voyage;

class VoyageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voyage::factory(10)->create();
    }
}
