<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodItemImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
    ];

    protected $appends = [
        'src',
    ];
    public function foodItem(): belongsTo
    {
        return $this->belongsTo(
            \App\Models\FoodItem::class,
        );
    }

    public function getSrcAttribute(): string
    {
        return asset("storage/{$this->filename}");
    }
}
