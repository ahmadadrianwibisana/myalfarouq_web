<?php

namespace App\Http\Controllers\AdminBesar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    public function index()
    {
        // Mengambil semua pemesanan dengan relasi yang diperlukan
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])->get();

        return view('pages.adminbesar.riwayat.index', compact('pemesanan'));
    }
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])->findOrFail($id);
    
        return view('pages.adminbesar.riwayat.show', compact('pemesanan'));
    }
}