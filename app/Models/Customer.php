<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Checkinout;
use App\Models\BookingRoom;


class Customer extends Model
{
    protected $table = 'customer';
    
    public function checkin_out() {
        return $this->hasMany(Checkinout::class);
    }

    public function booking_room() {
        return $this->hasMany(BookingRoom::class);
    }
}
