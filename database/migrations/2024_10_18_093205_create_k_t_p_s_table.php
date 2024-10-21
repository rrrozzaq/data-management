<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ktps', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('pekerjaan');
            $table->string('kewarganegaraan');
            $table->string('status_hubungan_keluarga'); // Kolom baru
            $table->string('dokumen_imigrasi')->nullable(); // Kolom baru
            $table->string('no_paspor')->nullable(); // Kolom baru
            $table->string('no_kitap')->nullable(); // Kolom baru
            $table->string('nama_ayah')->nullable(); // Kolom baru
            $table->string('nama_ibu')->nullable(); // Kolom baru
            $table->date('masa_berlaku');
            $table->unsignedBigInteger('kk_id')->nullable(false);
            $table->foreign('kk_id')->references('id')->on('kks')->onDelete('cascade');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('k_t_p_s');
    }
};
