<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Hotel::create([
            'name'=>'Crowne Plaza',
            'branches_num'=>3,
            'rooms_num'=>6
        ]);
    }
}
