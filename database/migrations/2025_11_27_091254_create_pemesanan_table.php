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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_unit_peralatan');
            $table->foreignId('user_id')->constrained('users');
            $table->string('nama_penyewa');
            $table->string('nik_penyewa', 18);
            $table->string('telepon_penyewa', 15);
            $table->string('alamat_penyewa', 100);
            $table->enum('jaminan_penyewa', ['ktp', 'stnk', 'bpkb', 'sim']);
            $table->string('foto_ktp_sim');
            $table->date('tgl_mulai');
            $table->integer('durasi_rental');
            $table->date('tgl_selesai');
            $table->decimal('total_biaya', 10, 2)->default(0);
            $table->uuid('verification_token')->unique();
            $table->enum('status_pemesanan', ['dipesan', 'dirental', 'selesai', 'dibatalkan'])
                  ->default('dipesan');
            $table->foreignId('diserahkan_oleh')->nullable()->constrained('users');
            $table->timestamp('tgl_verifikasi')->nullable();
            $table->dateTime('tgl_kembali_aktual')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
