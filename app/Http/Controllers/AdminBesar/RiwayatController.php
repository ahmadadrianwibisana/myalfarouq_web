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
        // Mengambil semua pemesanan dengan relasi yang diperlukan dan mengurutkannya berdasarkan tanggal_pemesanan terbaru
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])
            ->orderBy('tanggal_pemesanan', 'desc') // Mengurutkan berdasarkan tanggal pemesanan terbaru
            ->paginate(10); // Tambahkan pagination
    
        return view('pages.adminbesar.riwayat.index', compact('pemesanan'));
    }
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])->findOrFail($id);
    
        return view('pages.adminbesar.riwayat.show', compact('pemesanan'));
    }
}