<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';

    public function hotel_rooms(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
    public function branch_rooms(){
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function booking_room(){
        return $this->belongsTo(Booking::class,'booking_id');
    }
}
