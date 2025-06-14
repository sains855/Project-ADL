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
    Schema::create('quizzes', function (Blueprint $table) {
        $table->id(); // id (PK)
        $table->string('title'); // Judul
        $table->unsignedBigInteger('class_id'); // FK ke subjects
        $table->dateTime('start_time'); // Mulai
        $table->dateTime('end_time'); // Selesai
        $table->integer('duration'); // Durasi (menit)
        $table->timestamps();

        // Foreign key
        $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
