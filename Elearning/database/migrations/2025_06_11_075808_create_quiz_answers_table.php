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
    Schema::create('quiz_answers', function (Blueprint $table) {
        $table->id(); // id (PK)
        $table->unsignedBigInteger('question_id'); // FK ke quiz_questions
        $table->unsignedBigInteger('user_id'); // FK ke users (siswa)
        $table->string('answer'); // Jawaban siswa
        $table->boolean('is_correct'); // Apakah benar
        $table->timestamps();

        // Foreign keys
        $table->foreign('question_id')->references('id')->on('quiz_questions')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
    }
};
