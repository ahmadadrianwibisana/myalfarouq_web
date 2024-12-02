<?php

namespace App\Http\Controllers\AdminBesar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil semua pemesanan dengan relasi yang diperlukan
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])->get();

        // Menghitung total pendapatan
        $totalPendapatan = $this->hitungTotalPendapatan($pemesanan);

        return view('pages.adminbesar.laporan.index', compact('pemesanan', 'totalPendapatan'));
    }

    private function hitungTotalPendapatan($pemesanan)
    {
        $totalPendapatan = [
            'harian' => [],
            'mingguan' => [],
            'bulanan' => [],
            'tahunan' => [],
        ];
    
        foreach ($pemesanan as $item) {
            $tanggal = Carbon::parse($item->tanggal_pemesanan);
            
            // Hitung pendapatan harian
            $totalPendapatan['harian'][$tanggal->format('Y-m-d')] = 
                ($totalPendapatan['harian'][$tanggal->format('Y-m-d')] ?? 0) + $item->total_pembayaran;
    
            // Hitung pendapatan mingguan
            $totalPendapatan['mingguan'][$tanggal->format('W-Y')] = 
                ($totalPendapatan['mingguan'][$tanggal->format('W-Y')] ?? 0) + $item->total_pembayaran;
    
            // Hitung pendapatan bulanan
            $totalPendapatan['bulanan'][$tanggal->format('Y-m')] = 
                ($totalPendapatan['bulanan'][$tanggal->format('Y-m')] ?? 0) + $item->total_pembayaran;
    
            // Hitung pendapatan tahunan
            $totalPendapatan['tahunan'][$tanggal->format('Y')] = 
                ($totalPendapatan['tahunan'][$tanggal->format('Y')] ?? 0) + $item->total_pembayaran;
        }
    
        return $totalPendapatan;
    }

    private function hitungTotalPendapatanMingguan()
    {
        return Pemesanan::where('tanggal_pemesanan', '>=', Carbon::now()->startOfWeek())
            ->sum('total_pembayaran');
    }

    private function hitungTotalPendapatanTahunan()
    {
        return Pemesanan::where('tanggal_pemesanan', '>=', Carbon::now()->startOfYear())
            ->sum('total_pembayaran');
    }

    public function show($id)
    {
        // Mengambil pemesanan berdasarkan ID dengan relasi yang diperlukan
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])->findOrFail($id);

        // Menghitung total pendapatan mingguan dan tahunan
        $totalPendapatanMingguan = $this->hitungTotalPendapatanMingguan();
        $totalPendapatanTahunan = $this->hitungTotalPendapatanTahunan();

        return view('pages.adminbesar.laporan.show', compact('pemesanan', 'totalPendapatanMingguan', 'totalPendapatanTahunan'));
    }

    // Optional: Add methods for filtering by date range
    public function filterByDate(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])
            ->whereBetween('tanggal_pemesanan', [$startDate, $endDate])
            ->get();

        $totalPendapatan = $this->hitungTotalPendapatan($pemesanan);

        return view('pages.adminbesar.laporan.index', compact('pemesanan', 'totalPendapatan'));
    }
}