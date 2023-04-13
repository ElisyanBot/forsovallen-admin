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
        Schema::table('events', function (Blueprint $table) {
            $table->string('title');
            $table->mediumText('desc');
            $table->string('location');
            $table->string('time');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('desc');
            $table->dropColumn('location');
            $table->dropColumn('time');
            $table->dropColumn('date');
        });
    }
};
