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
            $table->unsignedBigInteger('module_id'); // FK ke subjects
            $table->unsignedBigInteger('class_id'); // FK ke subjects
            $table->dateTime('due_date'); // Batas akhir
            $table->timestamps();
            $table->unsignedBigInteger('user_id'); // FK ke users (dosen)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            // Foreign key
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
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
