<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [
        'id',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function booking() {
        return $this->hasMany(Booking::class);
    }
}
