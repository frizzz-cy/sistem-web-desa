<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('kategori');
            $table->string('harga');
            $table->string('status_stok');
            $table->text('deskripsi');
            $table->string('nama_penjual');
            $table->string('no_whatsapp');
            $table->string('foto_produk')->nullable(); // Boleh kosong sementara
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produks');
    }
};