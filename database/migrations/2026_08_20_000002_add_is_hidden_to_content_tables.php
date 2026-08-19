<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->boolean('is_hidden')->default(false)->after('views');
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->boolean('is_hidden')->default(false)->after('deskripsi');
        });

        Schema::table('produks', function (Blueprint $table) {
            $table->boolean('is_hidden')->default(false)->after('foto_produk');
        });
    }

    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn('is_hidden');
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn('is_hidden');
        });

        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('is_hidden');
        });
    }
};
