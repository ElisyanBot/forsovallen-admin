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
        Schema::table('food_items', function (Blueprint $table) {
            $table->string('name');
            $table->mediumText('desc');
            $table->integer('price');
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_items', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('desc');
            $table->dropColumn('price');
            $table->dropColumn('status');
        });
    }
};
