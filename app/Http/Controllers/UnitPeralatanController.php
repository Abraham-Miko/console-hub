<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitPeralatan;
use App\Models\JenisPeralatan;
use Illuminate\Support\Facades\Validator; // Tambahkan ini

class UnitPeralatanController extends Controller
{
    public function index() {
        $unit_peralatans = UnitPeralatan::with('jenis_peralatan')->latest()->get();
        $jenisPeralatans = JenisPeralatan::all();
        // Pastikan Anda memanggil view 'admin.unit_peralatan.index'
        return view('admin.unit_peralatan.index', compact('unit_peralatans', 'jenisPeralatans'));
    }

    public function store(Request $request) {
        // 1. Validasi Input untuk Penambahan Massal
        $validator = Validator::make($request->all(), [
            'id_jenis_peralatan' => 'required|exists:jenis_peralatans,id_jenis_peralatan',
            'nomor_seri_awal'    => 'required|string|max:255',
            'jumlah_unit'        => 'required|integer|min:1|max:500', // Batasi maksimal 500 unit
            'warna'              => 'required|string|max:255',
            'kondisi'            => 'required|in:baik,rusak',
            'status_peralatan'   => 'required|in:tersedia,dipesan,dirental,perawatan',
        ], [
            'nomor_seri_awal.required' => 'Nomor Seri Awal wajib diisi.',
            'jumlah_unit.required'     => 'Jumlah Unit wajib diisi.',
            'jumlah_unit.min'          => 'Jumlah Unit minimal 1.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $jumlahUnit = (int)$data['jumlah_unit'];
        $idJenisPeralatan = $data['id_jenis_peralatan'];
        $nomorSeriAwal = trim($data['nomor_seri_awal']);

        // Cek apakah Nomor Seri Awal sepenuhnya berupa angka (sehingga bisa diincrement)
        $isNumeric = ctype_digit($nomorSeriAwal);
        $nomorSeriSaatIni = $nomorSeriAwal;

        if ($isNumeric) {
            $nomorSeriSaatIni = (int)$nomorSeriAwal;
        }

        // 2. Loop untuk Membuat Banyak Unit
        $createdCount = 0;
        $duplicateCount = 0;

        for ($i = 0; $i < $jumlahUnit; $i++) {
            $nomorSeriBaru = (string)$nomorSeriSaatIni;

            $newUnitData = [
                'id_jenis_peralatan' => $idJenisPeralatan,
                'warna'              => $data['warna'],
                'kondisi'            => $data['kondisi'],
                'status_peralatan'   => $data['status_peralatan'],
                'nomor_seri'         => $nomorSeriBaru, // Tetapkan nomor seri baru
            ];

            // Cek duplikasi Nomor Seri untuk Jenis Peralatan yang sama
            $isDuplicate = UnitPeralatan::where('nomor_seri', $nomorSeriBaru)
                ->where('id_jenis_peralatan', $idJenisPeralatan)
                ->exists();

            if (!$isDuplicate) {
                // Buat entri baru di database
                UnitPeralatan::create($newUnitData);
                $createdCount++;
            } else {
                $duplicateCount++;
            }

            // Increment untuk unit berikutnya (hanya jika numeric)
            if ($isNumeric) {
                $nomorSeriSaatIni++;
            }
        }

        // 3. Respon Pengguna
        $message = "Berhasil menambahkan **$createdCount** unit peralatan baru.";

        if ($duplicateCount > 0) {
            $message .= " ($duplicateCount unit dengan Nomor Seri yang sama per Jenis Peralatan telah dilewati.)";
        } elseif ($createdCount == 0 && $jumlahUnit > 0) {
            // Kasus di mana user mencoba menambahkan unit, tetapi semuanya sudah ada (duplikat)
            $message = "Gagal menambahkan unit peralatan. Semua unit yang diinput sudah ada (duplikat).";
        }

        return redirect()->route('unit_peralatan.index')->with('success', $message);
    }

    public function update(Request $request, UnitPeralatan $unit_peralatan) {
        $validateData = $request->validate([
            'id_jenis_peralatan' => ['required'],
            // Tambahkan validasi unik, kecuali untuk dirinya sendiri
            'nomor_seri' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('unit_peralatans')->where(function ($query) use ($request, $unit_peralatan) {
                return $query->where('id_jenis_peralatan', $request->id_jenis_peralatan)
                             ->where('id_unit_peralatan', '!=', $unit_peralatan->id_unit_peralatan);
            })],
            'warna' => ['required', 'string'],
            'kondisi' => ['required', 'string'],
            'status_peralatan' => ['required', 'string'],
        ]);

        $unit_peralatan->update($validateData);
        return redirect()->route('unit_peralatan.index')->with('success', 'Unit peralatan berhasil diperbarui.');
    }

    public function destroy(UnitPeralatan $unit_peralatan) {
        $unit_peralatan->delete();
        return redirect()->route('unit_peralatan.index')->with('success', 'Unit peralatan berhasil dihapus.');
    }
}
