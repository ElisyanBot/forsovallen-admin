<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FoodItem extends Model
{
    use HasFactory;

     protected $fillable = [
         'name',
         'desc',
         'status',
         'price',
         'by_category_id',
    ];

     public function foodCategory()
    {
        return $this->belongsTo(
            \App\Models\FoodCategory::class,
            'by_category_id',
        );
    }

    public function image() : hasOne
    {
        return $this->hasOne(FoodItemImage::class );
    }
}
