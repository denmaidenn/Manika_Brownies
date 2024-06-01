<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('kode_transaksi')->primary();
            $table->string('kode_kue');
            $table->string('nama_pembeli');
            $table->string('nomor_telepon');
            $table->string('alamat');
            $table->string('catatan');
            $table->integer('jumlah_kue');
            $table->integer('total_harga');
            $table->timestamps();

            $table->foreign('kode_kue')->references('kode_kue')->on('products')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
