<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnitPeralatan;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';

    protected $fillable = [
        'id_unit_peralatan',
        'user_id',
        'nama_penyewa',
        'nik_penyewa',
        'telepon_penyewa',
        'alamat_penyewa',
        'jaminan_penyewa',
        'foto_ktp_sim',
        'tgl_mulai',
        'durasi_rental',
        'tgl_selesai',
        'pengiriman',
        'pembayaran',
        'bukti_pembayaran',
        'total_biaya',
        'verification_token',
        'status_pemesanan',
        'diserahkan_oleh',
        'tgl_verifikasi',
        'tgl_kembali_aktual'
    ];

    public function UnitPeralatan() {
        return $this->belongsTo(UnitPeralatan::class, 'id_unit_peralatan');
    }
}
