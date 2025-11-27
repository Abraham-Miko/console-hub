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
        Schema::create('jenis_peralatans', function (Blueprint $table) {
            $table->id('id_jenis_peralatan');
            $table->enum('kategori', ['console', 'vr', 'display']);
            $table->string('merek');
            $table->decimal('harga_rental_per_hari', 10, 2);
            $table->text('deskripsi');
            $table->string('foto_peralatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_peralatans');
    }
};
