<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReserveRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'adults',
        'children',
        'tent_spots',
        'caravan_spots',
        'check_in',
        'check_out',
    ];

    public function rooms(): hasMany
    {
        return $this->hasMany(
            \App\Models\BookedRoom::class,
        );
    }
}
