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
    Schema::create('destinasi', function (Blueprint $table) {
        $table->id();
        $table->string('nama_destinasi');
        $table->foreignId('kategori_id')->nullable()->constrained('kategori')->nullOnDelete();
        $table->string('lokasi')->nullable();
        $table->text('deskripsi')->nullable();
        $table->string('gambar')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi');
    }
};
