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
        Schema::create('history_beritas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('berita_id');
            $table->foreign('berita_id')->references('id')->on('beritas')->onDelete('cascade');
            $table->enum('old_status', ['Pending', 'published', 'Archived'])->default('Pending');
            $table->enum('new_status', ['Pending', 'published', 'Archived'])->default('Pending');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_beritas');
    }
};
