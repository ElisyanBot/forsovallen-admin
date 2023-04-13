<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;

    public function foodItems()
    {
        return $this->hasMany(
            \App\models\FoodItem::class,
            'by_category_id',
        );
    }
}
