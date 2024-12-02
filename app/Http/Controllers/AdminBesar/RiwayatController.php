<?php

namespace App\Http\Controllers\AdminBesar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Riwayat; // Pastikan Anda memiliki model Riwayat
use App\Models\Pemesanan; // Pastikan Anda memiliki model Pemesanan
use App\Models\Pembayaran; // Pastikan Anda memiliki model Pembayaran
use App\Models\DataAdministrasi; // Pastikan Anda memiliki model DataAdministrasi

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data riwayat dengan eager loading
        $riwayats = Riwayat::with(['pemesanan', 'pembayaran', 'dataAdministrasi'])
            ->get();

        return view('pages.adminbesar.riwayat.index', compact('riwayats'));
    }

    public function detail($id)
    {
        // Ambil detail riwayat berdasarkan ID dengan eager loading
        $riwayat = Riwayat::with(['pemesanan', 'pembayaran', 'dataAdministrasi'])
            ->findOrFail($id); // Menggunakan findOrFail untuk menangani kasus tidak ditemukan

        return view('pages.adminbesar.riwayat.detail', compact('riwayat'));
    }
}