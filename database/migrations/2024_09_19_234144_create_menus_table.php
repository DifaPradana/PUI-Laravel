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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('id_menu');
            $table->string('nama_menu');
            $table->string('deskripsi');
            $table->string('gambar');
            $table->integer('harga');
            $table->enum('status', ['tersedia', 'habis', 'nonaktif']);
            $table->unsignedBigInteger('id_kategori_menu');
            $table->foreign('id_kategori_menu')->references('id_kategori_menu')->on('kategori_menus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
