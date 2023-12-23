<?php

namespace App\Models;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Checkinout;

class Room extends Model
{
    protected $table = 'room';

    public function room_type() {
        return $this->belongsTo(RoomType::class);
    }

    public function checkin_out() {
        return $this->hasMany(Checkinout::class);
    }
}
