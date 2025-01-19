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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade'); // Relasi ke tabel 'rooms'
            $table->string('name'); // Nama orang yang memesan
            $table->string('phone'); // Nomor telepon
            $table->date('date'); // Tanggal pemesanan
            $table->enum('status', ['Unpaid', 'Paid']); // Tanggal pemesanan
            $table->integer('total_amount'); // Nomor telepon
            $table->time('start_time'); // Waktu mulai
            $table->time('end_time'); // Waktu selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
