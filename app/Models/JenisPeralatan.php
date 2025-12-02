<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnitPeralatan;

class JenisPeralatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jenis_peralatan';

    protected $fillable = [
        'kategori',
        'merek',
        'harga_rental_per_hari',
        'deskripsi',
        'foto_peralatan',
    ];

    public function unit_peralatans() {
        return $this->hasMany(UnitPeralatan::class, 'id_jenis_peralatan');
    }
}
