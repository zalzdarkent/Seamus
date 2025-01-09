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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama room
            $table->string('category'); // Kategori room
            $table->string('photo'); // Foto room
            $table->decimal('price_per_hour', 10, 2); // Harga per jam
            $table->timestamps();
        });

        Schema::create('facility_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade'); // Relasi ke tabel rooms
            $table->foreignId('facility_id')->constrained('facilities')->onDelete('cascade'); // Relasi ke tabel facilities
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
