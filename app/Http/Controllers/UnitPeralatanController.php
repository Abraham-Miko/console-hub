<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitPeralatan;
use App\Models\JenisPeralatan;

class UnitPeralatanController extends Controller
{
    public function index() {
        $unit_peralatans = UnitPeralatan::with('jenis_peralatan')->latest()->get();
        $jenisPeralatans = JenisPeralatan::all();
        return view('admin.unit_peralatan.index', compact('unit_peralatans', 'jenisPeralatans'));
    }

    public function store(Request $request) {
        // dd($request);
        $validateData = $request->validate([
            'id_jenis_peralatan' => ['required'],
            'nomor_seri' => ['required'],
            'warna' => ['required', 'string'],
            'kondisi' => ['required', 'string'],
            'status_peralatan' => ['required', 'string'],
        ]);

        UnitPeralatan::create($validateData);
        return redirect()->route('unit_peralatan.index')->with('success', 'Unit peralatan baru berhasil ditambahkan.');
    }

    public function update(Request $request, UnitPeralatan $unit_peralatan) {
        $validateData = $request->validate([
            'id_jenis_peralatan' => ['required'],
            'nomor_seri' => ['required'],
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
