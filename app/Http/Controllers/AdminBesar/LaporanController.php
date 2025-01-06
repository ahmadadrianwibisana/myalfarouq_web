<?php

namespace App\Http\Controllers\AdminBesar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PemesananExport;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua pemesanan dengan relasi yang diperlukan
        $query = Pemesanan::with(['user', 'openTrip', 'privateTrip', 'dataAdministrasi', 'pembayaran'])
            ->where('status', 'terkonfirmasi')
            ->whereHas('dataAdministrasi', function($query) {
                $query->where('status', 'approved');
            })
            ->whereHas('pembayaran', function($query) {
                $query->where('status_pembayaran', 'success');
            })
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
    
        // Filter berdasarkan nama pengguna
        if ($request->filled('user_name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            });
        }
    
        // Mengambil semua pemesanan yang sudah difilter
        $pemesanan = $query->paginate(10)->appends($request->except('page')); // Tambahkan appends
    
        // Menghitung total pendapatan
        $totalPendapatan = $this->hitungTotalPendapatan($pemesanan);
    
        // Ambil semua pengguna untuk filter
        $users = User::all();
    
        return view('pages.adminbesar.laporan.index', compact('pemesanan', 'totalPendapatan', 'users'));
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

    public function exportExcel()
    {
        return Excel::download(new PemesananExport, 'laporan_pemesanan.xlsx');
    }
}