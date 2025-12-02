<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Pemesanan;
use App\Models\JenisPeralatan;
use App\Models\UnitPeralatan;

class PemesananController extends Controller
{
    public function index() {
        $pemesanans = Pemesanan::with('unitPeralatan.jenis_peralatan')->latest()->get();
        // dd($pemesanans);

        $allJenisPeralatans = JenisPeralatan::all();

        $unitTersediaCreate = UnitPeralatan::where('status_peralatan', 'tersedia')
                                    ->with('jenis_peralatan')
                                    ->get();
        // dd($unitTersediaCreate->toArray());
        $cascadingDataEdit = [];
        foreach ($pemesanans as $pemesanan) {
            $currentUnit = $pemesanan->unitPeralatan;

            if ($currentUnit && !$currentUnit->relationLoaded('jenis_peralatan')) {
                $currentUnit->load('jenis_peralatan');
            }

            $availableUnitsBase = $unitTersediaCreate;

            $allUnitsForDropdown = $availableUnitsBase->toBase()
                ->merge([$currentUnit])
                ->unique('id_unit_peralatan')
                ->values();

                if ($pemesanan->id == 1) {
            }
            // dd($availableUnitsBase);
            $cascadingDataEdit[$pemesanan->id] = $allUnitsForDropdown;

        }
        // dd($cascadingDataEdit);
        return view('admin.pemesanan.index', [
            'pemesanans' => $pemesanans,
            'allJenisPeralatans' => $allJenisPeralatans,
            'unitTersediaCreate' => $unitTersediaCreate, // Menggantikan $unitTersedia lama
            'cascadingDataEdit' => $cascadingDataEdit,   // Variabel baru untuk Edit Modals
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'id_unit_peralatan' => ['required'],
            'nama_penyewa' => ['required', 'string', 'max:255'],
            'nik_penyewa' => ['required', 'max:18'],
            'telepon_penyewa' => ['required', 'max:13'],
            'alamat_penyewa' => ['required'],
            'jaminan_penyewa' => ['required'],
            'status_pemesanan' => ['required'],
            'foto_ktp_sim' => ['image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'tgl_mulai' => ['required'],
            'durasi_rental' => ['required', 'integer'],
            'tgl_selesai' => ['required'],
            'total_biaya' => ['required'],
        ]);

        $data = $validatedData;

        if ($request->hasFile('foto_ktp_sim')) {
            $extension = $request->file('foto_ktp_sim')->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $destinationPath = storage_path('app/public/pemesanan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
            $request->file('foto_ktp_sim')->move($destinationPath, $filename);

            $data['foto_ktp_sim'] = $filename;
        }
        // dd($data);

        do {
            $tokenVerifikasi = Str::random(36);
        } while (Pemesanan::where('verification_token', $tokenVerifikasi)->exists());
        $userId = Auth::id();

        $data['verification_token'] = $tokenVerifikasi;
        $data['user_id'] = $userId;

        $pemesanan = Pemesanan::create($data);

        $unit = UnitPeralatan::find($pemesanan->id_unit_peralatan);

        if ($unit) {
            $statusPemesanan = $pemesanan->status_pemesanan;
            $newStatusUnit = $statusPemesanan;

            // Cek Prioritas: JANGAN ubah jika sedang Perawatan
            if ($unit->status_peralatan === 'perawatan') {
                // Kita tidak perlu menghentikan proses, cukup jangan simpan perubahan status unit.
                return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil, Unit sedang dalam Perawatan.');
            }

            // Tentukan Status Unit berdasarkan Pemesanan
            if ($statusPemesanan === 'dipesan' || $statusPemesanan === 'dirental') {
                $newStatusUnit = $statusPemesanan;
            } else { // Jika Selesai atau Dibatalkan
                $newStatusUnit = 'tersedia';
            }

            // Simpan Perubahan
            if ($unit->status_peralatan !== $newStatusUnit) {
                $unit->status_peralatan = $newStatusUnit;
                $unit->save();
            }
        }

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan baru berhasil ditambahkan.');
    }

    public function update(Request $request, Pemesanan $pemesanan) {
        // dd($request);
        $validatedData = $request->validate([
            'id_unit_peralatan' => ['required'],
            'nama_penyewa' => ['required', 'string', 'max:255'],
            'nik_penyewa' => ['required', 'max:18'],
            'telepon_penyewa' => ['required', 'max:13'],
            'alamat_penyewa' => ['required'],
            'jaminan_penyewa' => ['required'],
            'status_pemesanan' => ['required'],
            'foto_ktp_sim' => ['image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'tgl_mulai' => ['required'],
            'durasi_rental' => ['required', 'integer'],
            'tgl_selesai' => ['required'],
            'total_biaya' => ['required'],
        ]);

        $data = $validatedData;
        // dd($data);
        if($request->hasFile('foto_ktp_sim')) {
            if($pemesanan->foto_ktp_sim) {
                $pathFotoLengkap = 'pemesanan' . '/' . $pemesanan->foto_ktp_sim;
                if(Storage::disk('public')->exists($pathFotoLengkap)) {
                    Storage::disk('public')->delete($pathFotoLengkap);
                }
            }
            $file = $request->file('foto_ktp_sim');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;

            $destinationPath = storage_path('app/public/pemesanan');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $file->move($destinationPath, $filename);
            $data['foto_ktp_sim'] = $filename;
        } else {
            unset($data['foto_ktp_sim']);
        }

        $idUnitLama = $pemesanan->id_unit_peralatan;

        $pemesanan->update($data);

        if ($request->id_unit_peralatan !== $idUnitLama) {

            $unitLama = UnitPeralatan::find($idUnitLama);

            if ($unitLama) {
                $unitLama->status_peralatan = 'tersedia';
                $unitLama->save();
            }
        }

        $status = $data['status_pemesanan'];
        if($pemesanan) {
            $unit = UnitPeralatan::find($pemesanan->id_unit_peralatan);

            if ($unit) {
                if($status == "dipesan" || $status == "dirental") {
                    $unit->status_peralatan = $status;

                } else {
                    $unit->status_peralatan = "tersedia";
                }
                $unit->save();
            }
        }

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy(Pemesanan $pemesanan) {
        $unit = $pemesanan->unitPeralatan;

        if ($unit) {
            $activeBookingsExist = Pemesanan::where('id_unit_peralatan', $unit->id_unit_peralatan)
                                        ->whereIn('status_pemesanan', ['dipesan', 'dirental'])
                                        ->where('id', '!=', $pemesanan->id)
                                        ->exists();

            if (!$activeBookingsExist) {
                if ($unit->status_peralatan !== 'perawatan') { // JANGAN ubah jika sedang perawatan
                    $unit->status_peralatan = 'tersedia';
                    $unit->save();
                }
            }
            // Jika ada pemesanan aktif lain, biarkan status unit tetap (dipesan/dirental).
        }

        if ($pemesanan->foto_ktp_sim) {
            $pathFotoLengkap = 'pemesanan' . '/' . $pemesanan->foto_ktp_sim;

            if (Storage::disk('public')->exists($pathFotoLengkap)) {
                Storage::disk('public')->delete($pathFotoLengkap);
            }
        }

        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }

    public function downloadQrCode($token) {
        return view('admin.verifikasi.qr_konversi_page', [
                'token' => $token
            ]);
    }

    public function konfirmasiAksi(Request $request, Pemesanan $pemesanan) {
        $path = $request->path();

        if (str_contains($path, 'konfirmasi')) {
            $newPemesananStatus = 'dirental';
            $newUnitStatus = 'dirental';
            $message = 'Serah terima kunci berhasil. Unit telah berstatus Dirental.';
        } elseif (str_contains($path, 'pengembalian')) {
            $newPemesananStatus = 'selesai';
            $newUnitStatus = 'tersedia';
            $message = 'Pengembalian unit berhasil dikonfirmasi.';
        } else {
            return redirect()->back()->with('error', 'Aksi tidak valid.');
        }

        // 2. Proses Transaksi Atomik
        // Memastikan update Pemesanan dan Unit berjalan sukses bersamaan
        DB::transaction(function () use ($pemesanan, $newPemesananStatus, $newUnitStatus) {

            $unit = $pemesanan->unitPeralatan; // Ambil Unit peralatan terkait

            // a. Update Status Pemesanan
            $pemesanan->status_pemesanan = $newPemesananStatus;

            // Tambahkan tgl_verifikasi saat serah terima
            if ($newPemesananStatus === 'dirental') {
                 $pemesanan->diserahkan_oleh = Auth::id();
                 $pemesanan->tgl_verifikasi = now();
            }
            // Tambahkan tgl_kembali_aktual saat pengembalian
            if ($newPemesananStatus === 'selesai') {
                 $pemesanan->tgl_kembali_aktual = now();
            }
            $pemesanan->save();

            if ($unit && $unit->status_peralatan !== 'perawatan') {

                if ($newPemesananStatus === 'selesai' || $newPemesananStatus === 'dibatalkan') {
                    $unit->status_peralatan = 'tersedia';
                } else {
                    $unit->status_peralatan = $newUnitStatus;
                }
                $unit->save();
            }
        });

        return redirect()->route('verifikasi-pelanggan')->with('success', $message);
    }
}
