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
        Schema::create('logo_logins', function (Blueprint $table) {
            $table->id();
            $table->string('judul_logo_login');
            $table->string('logo_login');
            $table->enum('status_logo_login', ['active', 'non-active'])->default('non-active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_logins');
    }
};
