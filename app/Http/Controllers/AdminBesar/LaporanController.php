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
        // Mengambil semua pemesanan dengan relasi yang diperlukan dan filter sesuai kriteria
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])
            ->where('status', 'terkonfirmasi')
            ->whereHas('dataAdministrasi', function($query) {
                $query->where('status', 'approved');
            })
            ->whereHas('pembayaran', function($query) {
                $query->where('status_pembayaran', 'success');
            })
            ->get();
    
        // Menghitung total pendapatan
        $totalPendapatan = $this->hitungTotalPendapatan($pemesanan);
    
        return view('pages.adminbesar.laporan.index', compact('pemesanan', 'totalPendapatan'));
    }
    
    private function hitungTotalPendapatan($pemesanan)
    {
        $totalPendapatan = [
            'bulanan' => [],
            'tahunan' => [],
        ];
    
        foreach ($pemesanan as $item) {
            $tanggal = Carbon::parse($item->tanggal_pemesanan);
    
            // Hitung pendapatan bulanan
            $totalPendapatan['bulanan'][$tanggal->format('Y-m')] = 
                ($totalPendapatan['bulanan'][$tanggal->format('Y-m')] ?? 0) + $item->total_pembayaran;
    
            // Hitung pendapatan tahunan
            $totalPendapatan['tahunan'][$tanggal->format('Y')] = 
                ($totalPendapatan['tahunan'][$tanggal->format('Y')] ?? 0) + $item->total_pembayaran;
        }
    
        return $totalPendapatan;
    }

    public function totalPendapatanPerBulan(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        // Validasi input bulan dan tahun
        if (!$month || !$year) {
            return response()->json(['error' => 'Bulan dan tahun harus diisi'], 400);
        }

        $totalPendapatan = Pemesanan::whereMonth('tanggal_pemesanan', $month)
            ->whereYear('tanggal_pemesanan', $year)
            ->where('status', 'terkonfirmasi')
            ->whereHas('dataAdministrasi', function($query) {
                $query->where('status', 'approved');
            })
            ->whereHas('pembayaran', function($query) {
                $query->where('status_pembayaran', 'success');
            })
            ->sum('total_pembayaran');

        return response()->json(['totalPendapatan' => $totalPendapatan]);
    }

    public function totalPendapatanPerTahun(Request $request)
    {
        $year = $request->input('year');

        // Validasi input tahun
        if (!$year) {
            return response()->json(['error' => 'Tahun harus diisi'], 400);
        }

        $totalPendapatan = Pemesanan::whereYear('tanggal_pemesanan', $year)
            ->where('status', 'terkonfirmasi')
            ->whereHas('dataAdministrasi', function($query) {
                $query->where('status', 'approved');
            })
            ->whereHas('pembayaran', function($query) {
                $query->where('status_pembayaran', 'success');
            })
            ->sum('total_pembayaran');

        return response()->json(['totalPendapatan' => $totalPendapatan]);
    }

    public function show($id)
    {
        // Mengambil pemesanan berdasarkan ID dengan relasi yang diperlukan
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])->findOrFail($id);

        return view('pages.adminbesar.laporan.show', compact('pemesanan'));
    }
    
    // Optional: Add methods for filtering by date range
    public function filterByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
    
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])
            ->whereBetween('tanggal_pemesanan', [$startDate, $endDate])
            ->where('status', 'terkonfirmasi')
            ->whereHas('dataAdministrasi', function($query) {
                $query->where('status', 'approved');
            })
            ->whereHas('pembayaran', function($query){
                $query->where('status_pembayaran', 'success');
            })
            ->get();
    
        $totalPendapatan = $this->hitungTotalPendapatan($pemesanan);
    
        return view('pages.adminbesar.laporan.index', compact('pemesanan', 'totalPendapatan'));
    }
}