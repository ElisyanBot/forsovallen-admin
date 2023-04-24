<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomImage extends Model
{
    use HasFactory;

    protected $appends = [
        'src',
    ];
    protected $fillable = [
        'filename',
    ];

    public function getSrcAttribute(): string
    {
        return asset('storage/' . $this->filename);
    }
    public function room(): belongsTo
    {
        return $this->belongsTo(\App\Models\Room::class);
    }
}
