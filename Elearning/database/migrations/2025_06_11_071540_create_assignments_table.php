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
    Schema::create('assignments', function (Blueprint $table) {
        $table->id(); // id (PK)
        $table->string('title'); // Judul tugas
        $table->text('description'); // Deskripsi tugas
        $table->unsignedBigInteger('subject_id'); // FK ke subjects
        $table->dateTime('due_date'); // Batas akhir
        $table->timestamps();

        // Foreign key
        $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
