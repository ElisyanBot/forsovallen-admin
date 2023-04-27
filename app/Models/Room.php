<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'beds',
    ];

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($room) {
            $room->image()->delete();
        });
    }


    public function image() : hasOne
    {
        return $this->hasOne(\App\Models\RoomImage::class);
    }

    public function bookedRooms(): hasMany
    {
        return $this->hasMany(
            \App\Models\BookedRoom::class,
            'room_id',
        );
    }
}
