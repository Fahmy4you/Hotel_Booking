<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [
        'id',
    ];

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getTotalDaysAttribute()
    {
        $start_date = Carbon::parse($this->start_date);
        $end_date = Carbon::parse($this->end_date);
        return $start_date->diffInDays($end_date);
    }
}
