<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAdministrasi;
use App\Models\User; // Mengimpor model User
use App\Models\Pemesanan; // Mengimpor model Pemesanan
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Pembayaran;
use App\Models\Riwayat;  


class DataAdministrasiController extends Controller
{
    // Menampilkan semua data administrasi
    public function index()
    {
        // Mengambil semua data administrasi beserta pemesanan dan pengguna
        $data_administrasis = DataAdministrasi::with(['pemesanan.user', 'pemesanan.openTrip', 'pemesanan.privateTrip'])
            ->join('pemesanans', 'data_administrasis.pemesanan_id', '=', 'pemesanans.id') // Bergabung dengan tabel pemesanan
            ->orderBy('pemesanans.tanggal_pemesanan', 'desc') // Mengurutkan berdasarkan tanggal pemesanan terbaru
            ->select('data_administrasis.*') // Memilih kolom dari data_administrasi
            ->get()
            ->groupBy('pemesanan_id');
    
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?'); // Konfirmasi hapus
    
        return view('pages.admin.data_administrasi.index', compact('data_administrasis'));
    }

    // Menampilkan form untuk menambah data administrasi
    public function create()
    {
        // Mengambil semua pengguna
        
        // Mengambil pemesanan yang sudah terkonfirmasi
        $pemesanan = Pemesanan::where('status', 'terkonfirmasi')->get(); // Pastikan status yang digunakan adalah 'terkonfirmasi'
    
        return view('pages.admin.data_administrasi.create', compact( 'pemesanan'));
    }
    // Menyimpan data administrasi baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'file_dokumen' => 'required|file|mimes:pdf,jpg,png,jpeg|max:10240',
            'status' => 'required|in:pending,approved,rejected',
        ]);
    
        // Cek status pemesanan
        $pemesanan = Pemesanan::find($validated['pemesanan_id']);
        if ($pemesanan->status !== 'terkonfirmasi') {
            return back()->withErrors(['pemesanan_id' => 'Pemesanan harus terkonfirmasi untuk menambah data administrasi.'])->withInput();
        }
    
        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file_dokumen') && $request->file('file_dokumen')->isValid()) {
            $filePath = $request->file('file_dokumen')->store('documents', 'public');
        }
    
        // Pastikan file berhasil diunggah
        if (!$filePath) {
            return back()->withErrors(['file_dokumen' => 'File upload failed or invalid.'])->withInput();
        }
    
        // Buat entri baru di DataAdministrasi dengan status 'pending'
        $dataAdministrasi = DataAdministrasi::create([
            'pemesanan_id' => $validated['pemesanan_id'],
            'file_dokumen' => $filePath,
            'status' => 'pending', // Tetapkan status ke 'pending'
            'user_id' => $pemesanan->user_id, // Ambil user_id dari pemesanan
        ]);

    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.data_administrasi.index')->with('success', 'Data Administrasi berhasil ditambahkan');
    }

    // Menampilkan detail data administrasi
// Menampilkan detail data administrasi
public function show($id)
{
    // Mengambil data administrasi berdasarkan ID
    $dataAdministrasi = DataAdministrasi::with(['pemesanan.user', 'pemesanan.openTrip', 'pemesanan.privateTrip'])->findOrFail($id);
    
    // Menentukan pesan berdasarkan status
    $message = '';
    if ($dataAdministrasi->status === 'rejected') {
        $message = 'Dokumen ini ditolak. Silakan periksa dokumen yang diunggah.';
    } elseif ($dataAdministrasi->status === 'approved') {
        $message = 'Selamat! Dokumen Anda telah disetujui.';
    } else {
        $message = 'Dokumen Anda masih dalam status pending.';
    }

    return view('pages.admin.data_administrasi.show', compact('dataAdministrasi', 'message'));
}

    // Menampilkan form untuk mengedit data administrasi
public function edit($id)
{
    // Mengambil data administrasi berdasarkan ID
    $dataAdministrasi = DataAdministrasi::with('pemesanan')->findOrFail($id);
    
    // Mengambil pemesanan yang sudah terkonfirmasi
    $pemesanan = Pemesanan::where('status', 'terkonfirmasi')->get();

    return view('pages.admin.data_administrasi.edit', compact('dataAdministrasi', 'pemesanan'));
}

// Memperbarui data administrasi
   // Memperbarui data administrasi
public function update(Request $request, $id)
{
    // Validasi input
    $validated = $request->validate([
        'pemesanan_id' => 'required|exists:pemesanans,id',
        'file_dokumen' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:10240',
        'status' => 'required|in:pending,approved,rejected',
    ]);

    // Mengambil data administrasi yang akan diperbarui
    $dataAdministrasi = DataAdministrasi::findOrFail($id);

    // Cek status pemesanan
    $pemesanan = Pemesanan::find($validated['pemesanan_id']);
    if ($pemesanan->status !== 'terkonfirmasi') {
        return back()->withErrors(['pemesanan_id' => 'Pemesanan harus terkonfirmasi untuk memperbarui data administrasi.'])->withInput();
    }

    // Handle file upload jika ada file baru
    if ($request->hasFile('file_dokumen') && $request->file('file_dokumen')->isValid()) {
        // Hapus file lama jika ada
        if ($dataAdministrasi->file_dokumen) {
            File::delete(public_path('storage/' . $dataAdministrasi->file_dokumen));
        }
        // Simpan file baru
        $filePath = $request->file('file_dokumen')->store('documents', 'public');
        $dataAdministrasi->file_dokumen = $filePath; // Update file_dokumen
    }

    // Update status
    $dataAdministrasi->pemesanan_id = $validated['pemesanan_id'];
    $dataAdministrasi->status = $validated['status'];

    // Jika status diubah menjadi 'rejected', tidak perlu menyimpan alasan
    if ($validated['status'] === 'rejected') {
        // Anda bisa menambahkan logika untuk menyimpan pesan penolakan di sini jika diperlukan
    }

    $dataAdministrasi->save();


    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('admin.data_administrasi.index')->with('success', 'Data Administrasi berhasil diperbarui');
}


        // Menghapus data administrasi
    public function destroy($id)
    {
        // Mengambil data administrasi berdasarkan ID
        $dataAdministrasi = DataAdministrasi::findOrFail($id);

        // Hapus file dokumen jika ada
        if ($dataAdministrasi->file_dokumen) {
            File::delete(public_path('storage/' . $dataAdministrasi->file_dokumen));
        }

        // Hapus data administrasi
        $dataAdministrasi->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.data_administrasi.index')->with('success', 'Data Administrasi berhasil dihapus');
    }

    public function editAll(Request $request, $pemesanan_id)
    {
        // Validasi input
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);
    
        // Mengambil semua data administrasi berdasarkan pemesanan_id
        $dataAdministrasis = DataAdministrasi::where('pemesanan_id', $pemesanan_id)->get();
    
        foreach ($dataAdministrasis as $dataAdministrasi) {
            $dataAdministrasi->status = $validated['status'];
            $dataAdministrasi->save();
        }
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.data_administrasi.index')->with('success', 'Status semua data administrasi berhasil diperbarui');
    }
    
    public function destroyAll($pemesanan_id)
    {
        // Retrieve all administrative data based on the pemesanan_id
        $dataAdministrasis = DataAdministrasi::where('pemesanan_id', $pemesanan_id)->get();
    
        // Check if there are any records to delete
        if ($dataAdministrasis->isEmpty()) {
            return redirect()->route('admin.data_administrasi.index')->with('error', 'Tidak ada data untuk dihapus.');
        }
    
        // Loop through each administrative data and delete
        foreach ($dataAdministrasis as $dataAdministrasi) {
            // Delete document file if it exists
            if ($dataAdministrasi->file_dokumen) {
                $filePath = public_path('storage/' . $dataAdministrasi->file_dokumen);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
            // Delete the administrative data
            $dataAdministrasi->delete();
        }
    
        // Redirect to the index page with a success message
        return redirect()->route('admin.data_administrasi.index')->with('success', 'Semua data administrasi berhasil dihapus');
    }
    
}