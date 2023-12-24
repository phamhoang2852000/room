<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Price extends Model
{
    protected $table = 'price';

    public function room() {
        return $this->belongsTo(Room::class);
    }
}
