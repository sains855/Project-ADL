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
    Schema::create('modules', function (Blueprint $table) {
        $table->id(); // id (PK)
        $table->string('title'); // Judul modul
        $table->text('content'); // Konten HTML/video/file
        $table->unsignedBigInteger('subject_id'); // FK ke subjects
        $table->unsignedBigInteger('created_by'); // FK ke users (guru)

        $table->timestamps(); // created_at & updated_at

        // Foreign keys
        $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
