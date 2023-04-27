<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReserveRoom extends Model
{
    use HasFactory, softDeletes;

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

    public static function boot ()
    {
        parent::boot();

        static::deleting(function ($reserveRoom) {
            $reserveRoom->rooms()->delete();
        });
    }
    public function rooms(): hasMany
    {
        return $this->hasMany(
            \App\Models\BookedRoom::class,
        );
    }
}
