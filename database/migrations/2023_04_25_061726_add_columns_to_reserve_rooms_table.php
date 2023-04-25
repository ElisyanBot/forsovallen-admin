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
        Schema::table('reserve_rooms', function (Blueprint $table) {
            $table->string('name');
            $table->string('email');
            $table->string('phone_number')->default('');
            $table->integer('adults')->default(0);
            $table->integer('children')->default(0);
            $table->integer('tent_spots')->default(0);
            $table->integer('caravan_spots')->default(0);
            $table->date('check_in');
            $table->date('check_out');
            $table->boolean('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reserve_rooms', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('phone_number');
            $table->dropColumn('number_of_adults');
            $table->dropColumn('number_of_children');
            $table->dropColumn('number_of_tent');
            $table->dropColumn('number_of_caravan');
            $table->dropColumn('check_in');
            $table->dropColumn('check_out');
        });
    }
};
