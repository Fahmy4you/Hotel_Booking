<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $guarded = [
        'id',
    ];

    public function fasilitas() {
        return $this->belongsTo(Category::class);
    }
}
