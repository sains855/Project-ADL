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
    Schema::create('notifications', function (Blueprint $table) {
        $table->id(); // id (PK)
        $table->unsignedBigInteger('user_id'); // Penerima notifikasi
        $table->text('content'); // Isi notifikasi
        $table->timestamp('read_at')->nullable(); // Waktu dibaca (nullable)
        $table->timestamp('created_at')->useCurrent(); // Waktu dibuat
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
