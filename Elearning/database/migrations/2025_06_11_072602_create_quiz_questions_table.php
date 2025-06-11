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
    Schema::create('quiz_questions', function (Blueprint $table) {
        $table->id(); // id (PK)
        $table->unsignedBigInteger('quiz_id'); // FK ke quizzes
        $table->text('question'); // Isi pertanyaan
        $table->json('options'); // Pilihan ganda (JSON)
        $table->string('correct'); // Jawaban benar
        $table->timestamps();

        // Foreign key
        $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
