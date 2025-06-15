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
        Schema::create('tugas_mahasiswas', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('modul_id'); // Pastikan kolom ini ada
    $table->unsignedBigInteger('mahasiswa_id');
    $table->text('jawaban')->nullable();
    $table->string('file_path')->nullable();
    $table->timestamps();

    // Foreign keys
    $table->foreign('modul_id')->references('id')->on('modules')->onDelete('cascade');
    $table->foreign('mahasiswa_id')->references('id')->on('users')->onDelete('cascade');
});

}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_mahasiswas');
    }
};
