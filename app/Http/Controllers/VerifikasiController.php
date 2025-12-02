<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class VerifikasiController extends Controller
{
    public function getDetailByToken($token) {
        $pemesanan = Pemesanan::with('unitPeralatan.jenis_peralatan')->where('verification_token', $token)->first();

        if (!$pemesanan) {
            return response()->json(['success' => false, 'message' => 'Token tidak valid.'], 404);
        }

        // Mengembalikan data lengkap sebagai JSON
        return response()->json([
            'success' => true,
            'pemesanan' => $pemesanan
        ]);
    }
}
