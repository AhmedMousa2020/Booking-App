<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Branch::create([
            'name'=>'branch 1',
            'address'=>'Dahab',
            'hotel_id'=>1,
            'rooms_num'=>2,
        ]);

        \App\Models\Branch::create([
            'name'=>'branch 2',
            'address'=>'sharm',
            'hotel_id'=>1,
            'rooms_num'=>2,
        ]);

        \App\Models\Branch::create([
            'name'=>'branch 3',
            'address'=>'Aswan',
            'hotel_id'=>1,
            'rooms_num'=>2,
        ]);
    }
}
