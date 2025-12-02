<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisPeralatan;

class UnitPeralatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_unit_peralatan';

    protected $fillable = [
        'id_jenis_peralatan',
        'nomor_seri',
        'warna',
        'kondisi',
        'status_peralatan',
    ];

    public function jenis_peralatan() {
        return $this->belongsTo(JenisPeralatan::class, 'id_jenis_peralatan');
    }
}
