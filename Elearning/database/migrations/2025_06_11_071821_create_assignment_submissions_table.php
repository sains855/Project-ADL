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
    Schema::create('assignment_submissions', function (Blueprint $table) {
        $table->id(); // id (PK)
        $table->unsignedBigInteger('assignment_id'); // FK ke assignments
        $table->unsignedBigInteger('user_id'); // FK ke users (siswa)
        $table->dateTime('submitted_at'); // Tanggal pengumpulan
        $table->text('file_url'); // Link file tugas
        $table->timestamps();

        // Foreign keys
        $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_submissions');
    }
};
