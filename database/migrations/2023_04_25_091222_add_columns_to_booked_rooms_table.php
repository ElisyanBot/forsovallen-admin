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
        Schema::table('booked_rooms', function (Blueprint $table) {
            $table->date('start_date');
            $table->date('end_date');

            $table->foreignIdFor(
                \App\Models\Room::class,
                'room_id'
            )->constrained('rooms');

            $table->foreignIdFor(
                \App\Models\ReserveRoom::class,
                'reserved_room_id'
            )->constrained('reserve_rooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booked_rooms', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
};
