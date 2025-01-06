<?php

namespace App\Http\Controllers\AdminBesar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\User;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua pemesanan dengan relasi yang diperlukan
        $query = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])
            ->orderBy('tanggal_pemesanan', 'desc'); // Mengurutkan berdasarkan tanggal pemesanan terbaru
    
        // Filter berdasarkan bulan
        if ($request->filled('month')) {
            $query->whereMonth('tanggal_pemesanan', $request->month);
        }

        // Filter berdasarkan tahun
        if ($request->filled('year')) {
            $query->whereYear('tanggal_pemesanan', $request->year);
        }
    
        // Filter berdasarkan jenis trip
        if ($request->filled('trip_type')) {
            $query->where('trip_type', $request->trip_type);
        }
    
        // Filter berdasarkan status pemesanan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // Filter berdasarkan nama pengguna
        if ($request->filled('user_name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            });
        }
    
        // Mengambil semua pemesanan yang sudah difilter
        $pemesanan = $query->paginate(10)->appends($request->except('page')); // Tambahkan appends

        // Ambil semua pengguna untuk filter
        $users = User::all();
    
        return view('pages.adminbesar.riwayat.index', compact('pemesanan', 'users'));
    }
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])->findOrFail($id);
    
        return view('pages.adminbesar.riwayat.show', compact('pemesanan'));
    }
}