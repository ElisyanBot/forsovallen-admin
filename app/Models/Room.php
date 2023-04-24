<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'beds',
    ];

    public function image() : hasOne
    {
        return $this->hasOne(\App\Models\RoomImage::class);
    }
}
