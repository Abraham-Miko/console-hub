<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use App\Models\JenisPeralatan;
use Illuminate\Http\Request;

class JenisPeralatanController extends Controller
{
    public function index() {
        $jenis_peralatans = JenisPeralatan::latest()->get();
        return view('admin.jenis_peralatan.index', compact('jenis_peralatans'));
    }

    public function store(Request $request) {
        // dd($request);
        $validatedData = $request->validate([
            'kategori' => ['required', 'string', 'max:255'],
            'merek' => ['required', 'string', 'max:255'],
            'harga_rental_per_hari' => ['required', 'numeric'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'foto_peralatan' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
        ]);

        // dd($validatedData);
        $data = $validatedData;

        if ($request->hasFile('foto_peralatan')) {
            $extension = $request->file('foto_peralatan')->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $destinationPath = storage_path('app/public/jenis_peralatan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
            $request->file('foto_peralatan')->move($destinationPath, $filename);

            $data['foto_peralatan'] = $filename;
        }
        JenisPeralatan::create($data);

        return redirect()->route('jenis_peralatan.index')->with('success', 'Jenis peralatan baru berhasil ditambahkan.');
    }

    public function update(Request $request, JenisPeralatan $jenis_peralatan) {
        // dd($request);
        $validatedData = $request->validate([
            'kategori' => ['required', 'string', 'max:255'],
            'merek' => ['required', 'string', 'max:255'],
            'harga_rental_per_hari' => ['required', 'numeric'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'foto_peralatan' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        $data = $validatedData;
        // dd($data);
        if($request->hasFile('foto_peralatan')) {
            if($jenis_peralatan->foto_peralatan) {
                $pathFotoLengkap = 'jenis_peralatan' . '/' . $jenis_peralatan->foto_peralatan;
                if(Storage::disk('public')->exists($pathFotoLengkap)) {
                    Storage::disk('public')->delete($pathFotoLengkap);
                }
            }
            $file = $request->file('foto_peralatan');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;

            $destinationPath = storage_path('app/public/jenis_peralatan');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $file->move($destinationPath, $filename);
            $data['foto_peralatan'] = $filename;
        } else {
            unset($data['foto_peralatan']);
        }
        $jenis_peralatan->update($data);

        return redirect()->route('jenis_peralatan.index')->with('success', 'Jenis peralatan berhasil diperbarui.');
    }

    public function destroy(JenisPeralatan $jenis_peralatan) {
        $styledMerek = "<span class=\"font-extrabold text-white bg-red-600 px-2 py-1 rounded\">{$jenis_peralatan->merek}</span>";
        if ($jenis_peralatan->unit_peralatans()->exists()) {
            return redirect()->route('jenis_peralatan.index')->with('error',
                "Model '{$styledMerek}' masih terhubung dengan unit peralatan yang ada. Harap hapus atau ubah unit peralatan tersebut terlebih dahulu."
            );
        }

        if ($jenis_peralatan->foto_peralatan) {
            $pathFotoLengkap = 'jenis_peralatan' . '/' . $jenis_peralatan->foto_peralatan;
            if(Storage::disk('public')->exists($pathFotoLengkap)) {
                Storage::disk('public')->delete($pathFotoLengkap);
            }
        }

        $jenis_peralatan->delete();

        return redirect()->route('jenis_peralatan.index')->with('success', 'Jenis peralatan berhasil dihapus.');
    }

    public function katalog() {
        $allJenis = JenisPeralatan::withCount(['unit_peralatans as stok_tersedia' => function ($query) {
            $query->where('status_peralatan', 'tersedia');
        }])
        ->with(['unit_peralatans' => function ($query) {
            $query->where('status_peralatan', 'tersedia')->limit(5);
        }])
        ->get();

        return view('layouts.katalog', compact('allJenis'));
    }
}
