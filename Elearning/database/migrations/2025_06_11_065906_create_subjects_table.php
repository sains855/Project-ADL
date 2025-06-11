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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id(); // id (PK)
            $table->string('name'); // Nama mapel
            $table->unsignedBigInteger('class_id'); // Kelas mapel (FK)

            // Foreign key constraint
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};

