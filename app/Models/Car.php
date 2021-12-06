<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'carnum',
        'carname',
        'brand',
        'image'
    ];

    public function getImageAttribute($value) {
        return '/storage/'.$value;
    }

    public function owner() {
        return $this->belongsTo(User::class);
    }
}
