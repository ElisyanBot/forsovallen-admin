<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookedRoom extends Model
{
    use HasFactory;

    public function room(): belongsTo
    {
        return $this->belongsTo(
            \App\Models\Room::class,
            'room_id',
        );
    }
    public function reservation(): belongsTo
    {
        return $this->belongsTo(
            \App\Models\ReserveRoom::class,
            'reserve_id',
        );
    }
}
