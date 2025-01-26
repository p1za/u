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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plane_id')->constrained('planes')->onDelete('cascade');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->foreignId('departure_city_id')->constrained('kota')->onDelete('cascade');
            $table->foreignId('arrival_city_id')->constrained('kota')->onDelete('cascade');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
