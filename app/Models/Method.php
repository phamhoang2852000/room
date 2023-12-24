<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Method extends Model
{
    protected $table = 'method';

    public function invoice() {
        return $this->hasMany(Invloce::class);
    }
}
