<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Room::create([
            'hotel_id'=>1,
            'branch_id'=>1,
            'booking_id'=>0,
            'price'=>100,
            'status'=>1,
            'type'=>0
        ]);

        \App\Models\Room::create([
            'hotel_id'=>1,
            'branch_id'=>1,
            'booking_id'=>0,
            'price'=>100,
            'status'=>1,
            'type'=>0
        ]);

        \App\Models\Room::create([
            'hotel_id'=>1,
            'branch_id'=>2,
            'booking_id'=>0,
            'price'=>200,
            'status'=>1,
            'type'=>1
        ]);

        \App\Models\Room::create([
            'hotel_id'=>1,
            'branch_id'=>2,
            'booking_id'=>0,
            'price'=>250,
            'status'=>1,
            'type'=>1
        ]);

        \App\Models\Room::create([
            'hotel_id'=>1,
            'branch_id'=>3,
            'booking_id'=>0,
            'price'=>450,
            'status'=>1,
            'type'=>2
        ]);

        \App\Models\Room::create([
            'hotel_id'=>1,
            'branch_id'=>3,
            'booking_id'=>0,
            'price'=>500,
            'status'=>1,
            'type'=>2
        ]);
    }
}
