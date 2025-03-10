<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Fasilitas;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [
        'id',
    ];

    public function room() {
        return $this->hasMany(Room::class);
    }

    public function fasilitas() {
        return $this->hasMany(Fasilitas::class);
    }
}
