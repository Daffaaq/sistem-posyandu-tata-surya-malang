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
        Schema::create('orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ayah');
            $table->enum('jenis_kelamin_ayah', ['Laki-laki']);
            $table->date('tanggal_lahir_ayah');
            $table->string('no_telepon_ayah');
            $table->string('email_ayah');
            $table->string('pekerjaan_ayah');
            $table->enum('agama_ayah', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']);
            $table->text('alamat_ayah');

            $table->string('nama_ibu');
            $table->enum('jenis_kelamin_ibu', ['Perempuan']);
            $table->date('tanggal_lahir_ibu');
            $table->string('no_telepon_ibu');
            $table->string('email_ibu');
            $table->string('pekerjaan_ibu');
            $table->enum('agama_ibu', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']);
            $table->text('alamat_ibu');

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
        Schema::dropIfExists('ibus');
    }
};
