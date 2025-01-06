<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\DataAdministrasi;
use App\Models\OpenTrip;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\PrivateTrip;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admins = Admin::count();
        $users = User::count();
        $data_administrasis = DataAdministrasi::count();
        $open_trips = OpenTrip::count();
        $private_trips = PrivateTrip::count();
        $pemesanans = Pemesanan::count();
        $pembayarans = Pembayaran::count();
    
        // Ambil data pemesanan per bulan
        $monthlyData = Pemesanan::selectRaw('DATE_FORMAT(tanggal_pemesanan, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

            // Pastikan data bulanan tidak kosong
        if ($monthlyData->isEmpty()) {
            $monthlyData = collect(['No Data' => 0]); // Menangani kasus tidak ada data
        }
    
        return view('pages.admin.index', compact('admins', 'users', 'data_administrasis', 'open_trips', 'private_trips', 'pemesanans', 'pembayarans', 'monthlyData'));
    }
    public function index()
    {
        $admins = Admin::all();
        return view('pages.admin.index', compact('admins'));
    }
}