<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('kode_kue')->primary();
            $table->string('nama_kue');
            $table->text('deskripsi');
            $table->integer('harga_kue');
            $table->string('gambar_kue')->nullable();
            $table->boolean('status_bs')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

