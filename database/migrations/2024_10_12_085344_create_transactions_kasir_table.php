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
        Schema::create('transactions_kasir', function (Blueprint $table) {
            $table->id();
            $table->text('item_kasir'); // Nama item
            $table->integer('jumlah_kasir'); // Jumlah item
            $table->integer('total_kasir'); // Total harga
            $table->decimal('pembayaran_kasir', 15, 2)->default(0);
            $table->decimal('kembalian_kasir', 15, 2)->default(0);
            $table->unsignedBigInteger('user_id'); // ID pengguna yang melakukan transaksi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions_kasir');
    }
};
