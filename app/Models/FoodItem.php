<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'desc',
        'status',
        'price',
    ];

     public function foodCategory()
    {
        return $this->belongsTo(
            \App\Models\FoodCategory::class,
            'by_category_id',
        );
    }
}
