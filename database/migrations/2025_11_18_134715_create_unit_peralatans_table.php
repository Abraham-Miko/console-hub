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
        Schema::create('unit_peralatans', function (Blueprint $table) {
            $table->id('id_unit_peralatan');
            $table->foreignId('id_jenis_peralatan');
            $table->string('nomor_seri');
            $table->string('warna');
            $table->enum('kondisi', ['baik', 'rusak']);
            $table->enum('status_peralatan', ['tersedia', 'dipesan', 'dirental', 'perawatan'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_peralatans');
    }
};
