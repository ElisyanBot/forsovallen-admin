<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_item_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('filename');

            $table->foreignIdFor(
                \App\Models\FoodItem::class,
                'food_item_id'
            )->constrained('food_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_item_images');
    }
};
