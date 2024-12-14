<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\OpenTrip;
use App\Models\PrivateTrip;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\DataAdministrasi;


class UserController extends Controller
{
    // Halaman Home
    public function home()
    {
        $artikels = Artikel::with('images')->take(3)->get();
        // Mengambil hanya 3 data open trip
        $open_trips = OpenTrip::take(3)->get();  
        return view('user.home', compact('artikels', 'open_trips'));
    }


    // Halaman Open Trip
    public function opentrip(Request $request)
    {
        $open_trips = OpenTrip::all(); 
        $query = OpenTrip::query();
    
        // Search by package name
        if ($request->filled('search')) {
            $query->where('nama_paket', 'like', '%' . $request->search . '%');
        }
    
        // Filter by destination
        if ($request->filled('destination') && $request->destination != '*') {
            $query->where('destinasi', $request->destination);
        }
    
        // Filter by duration
        if ($request->filled('duration') && $request->duration != '*') {
            $query->where('lama_keberangkatan', $request->duration);
        }
    
        $open_trips = $query->get();
    
        return view('user.opentrip', compact('open_trips'));
    }
    
    public function bookOpenTrip(Request $request, $id)
    {
        \Log::info('Request Method: ' . $request->method());
    
        // Pastikan pengguna sudah login
        if (!auth()->check()) {
            Alert::error('Gagal!', 'Anda harus login terlebih dahulu');
            return redirect()->route('login');
        }
    
        // Validasi input
        $validator = Validator::make($request->all(), [
            'jumlah_peserta' => 'required|integer|min:1',
            'trip_type' => 'required|string|in:open_trip', // Pastikan trip_type adalah 'open_trip'
        ]);
    
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan jumlah peserta valid!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            // Temukan open trip berdasarkan ID
            $openTrip = OpenTrip::findOrFail($id);
    
            // Hitung total pembayaran
            $totalPembayaran = $openTrip->harga * $request->jumlah_peserta;
    
            // Simpan data pemesanan ke dalam tabel pemesanan
            Pemesanan::create([
                'user_id' => auth()->id(),
                'trip_type' => $request->trip_type,
                'open_trip_id' => $openTrip->id,
                'tanggal_pemesanan' => now(),
                'jumlah_peserta' => $request->jumlah_peserta,
                'total_pembayaran' => $totalPembayaran,
                'status' => 'pending',
            ]);
    
            Alert::success('Sukses!', 'Pemesanan berhasil dilakukan!');
            return redirect()->route('user.detailopen', ['id' => $openTrip->id])->with('success', 'Pemesanan berhasil! Anda akan segera dihubungi admin.');
        } catch (\Exception $e) {
            \Log::error('Booking failed', ['error' => $e->getMessage()]);
            Alert::error('Gagal!', 'Pemesanan gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    // Method for detail open trip
    public function detailopen($id)
    {
        $open_trips = OpenTrip::find($id);
        return view('user.detailopen', compact('open_trips'));
    }



    // Halaman Artikel
    public function dokumen()
    {
        $artikels = Artikel::with('images')->get(); 
        return view('user.dokumen',compact('artikels'));
    }
    public function detailArtikel($id)
    {
        $artikel = Artikel::with('images')->find($id);
        return view('user.detail-artikel', compact('artikel'));
    }

     // Method for Detail page
    public function detail()
    {
         return view('user.detail');  // The view you want to show for the detail page
    }

    

    // Halaman Privat Trip
    public function privatetrip()
    {
        // Optional: You can pass any additional data to the view if needed
        return view('user.privatetrip');
    }

    public function storePrivateTrip(Request $request)
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            Alert::error('Gagal!', 'Anda harus login terlebih dahulu');
            return redirect()->route('login');
        }

        $validator = Validator::make($request->all(), [
            'no_telepon' => 'required|string|max:15',
            'nama_trip' => 'required|string|max:255',
            'destinasi' => 'required|string|max:255',
            'tanggal_pergi' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pergi',
            'star_point' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
            'deskripsi_trip' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Tambahkan debug
            \Log::error('Validation Failed', [
                'errors' => $validator->errors(),
                'input' => $request->all()
            ]);

            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Tambahkan debug sebelum create
            \Log::info('Attempting to create Private Trip', [
                'user_id' => auth()->id(),
                'data' => $request->all()
            ]);

            $privateTrip = PrivateTrip::create([
                'user_id' => auth()->id(), 
                'no_telepon' => $request->no_telepon,
                'nama_trip' => $request->nama_trip,
                'destinasi' => $request->destinasi,
                'tanggal_pergi' => $request->tanggal_pergi,
                'tanggal_kembali' => $request->tanggal_kembali,
                'star_point' => $request->star_point,
                'jumlah_peserta' => $request->jumlah_peserta,
                'deskripsi_trip' => $request->deskripsi_trip,
                'status' => 'pending',
                'tanggal_pengajuan' => now(),
            ]);

            // Tambahkan debug setelah create
            \Log::info('Private Trip Created', [
                'id' => $privateTrip->id
            ]);

            Alert::success('Sukses!', 'Private Trip telah berhasil ditambahkan!');
            return redirect()->route('user.privatetrip');
        } catch (\Exception $e) {
            // Tambahkan error logging
            \Log::error('Private Trip Creation Failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            Alert::error('Gagal!', 'Private Trip gagal ditambahkan: ' . $e->getMessage());
            return redirect()->back();
        }
    }



    // Halaman Profil Kami
    public function profilKami()
    {
        return view('user.profil-kami'); // Make sure this view exists
    }



    // Halaman Tentang Kami
    public function tentangKami()
    {
        return view('user.tentang-kami'); // Make sure this view exists
    }



    // Halaman Trip Saya
    public function tripsaya()
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            Alert::error('Gagal!', 'Anda harus login terlebih dahulu');
            return redirect()->route('login');
        }
    
        // Fetch the authenticated user's bookings with related open trips and private trips
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip','pembayaran'])
            ->where('user_id', auth()->id())
            ->get();
    
        return view('user.tripsaya', compact('pemesanans'));
    }

    // Ubah nama fungsi dari cancelBooking menjadi batalPemesanan
    public function batalPemesanan($id)
    {
        try {
            // Find the booking or fail
            $pemesanan = Pemesanan::findOrFail($id);
            
            // Check if the booking belongs to the authenticated user
            if ($pemesanan->user_id !== auth()->id()) {
                return response()->json(['error' => 'Unauthorized action.'], 403);
            }
    
            // Delete the booking
            $pemesanan->delete();
    
            // Return a JSON response
            return response()->json(['success' => true, 'message' => 'Pemesanan berhasil dibatalkan!']);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return response()->json(['error' => 'Terjadi kesalahan saat membatalkan pemesanan.'], 500);
        }
    }

     // Method for detail pemesanan
    public function detailPemesanan($id)
    {
         // Temukan pemesanan berdasarkan ID
        $pemesanan = Pemesanan::with(['openTrip', 'privateTrip', 'user', 'pembayaran', 'dataAdministrasi'])->findOrFail($id);
        
         // Get the payment information
         $pembayaran = $pemesanan->pembayaran; // This will retrieve the related payment record
    
        return view('user.detail-pemesanan', compact('pemesanan', 'pembayaran'));
    }

    public function editPemesanan($id)
    {
        $pemesanan = Pemesanan::with('openTrip')->findOrFail($id);
        
        // Pastikan hanya open_trip yang bisa diedit
        if ($pemesanan->trip_type !== 'open_trip') {
            return redirect()->route('user.tripsaya')->with('error', 'Hanya pemesanan open trip yang dapat diedit.');
        }

        // Cek status pemesanan
        if ($pemesanan->status !== 'pending') {
            return redirect()->route('user.tripsaya')->with('error', 'Pemesanan tidak dapat diedit karena statusnya sudah ' . ucfirst($pemesanan->status) . '.');
        }
    
        // Ambil semua open trips untuk dropdown
        $openTrips = OpenTrip::all();
    
        return view('user.edit-pemesanan', compact('pemesanan', 'openTrips'));
    }

    public function updatePemesanan(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        
        // Check the status of the booking
        if ($pemesanan->status !== 'pending') {
            return redirect()->route('user.tripsaya')->with('error', 'Pemesanan tidak dapat diperbarui karena statusnya sudah ' . ucfirst($pemesanan->status) . '.');
        }
    
        // Validate input
        $validator = Validator::make($request->all(), [
            'jumlah_peserta' => 'required|integer|min:1',
            'open_trip_id' => 'required|exists:open_trips,id', // Ensure the trip ID is valid
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Get the open trip to check the quota
        $openTrip = OpenTrip::findOrFail($request->open_trip_id);
    
        // Check if the number of participants exceeds the quota
        if ($request->jumlah_peserta > $openTrip->kuota) {
            return redirect()->back()->withErrors(['jumlah_peserta' => 'Jumlah peserta tidak boleh lebih dari kuota yang tersedia (' . $openTrip->kuota . ').'])->withInput();
        }
    
        // Calculate total payment
        $totalPembayaran = $openTrip->harga * $request->jumlah_peserta;
    
        // Update the booking
        $pemesanan->update([
            'jumlah_peserta' => $request->jumlah_peserta,
            'open_trip_id' => $request->open_trip_id,
            'total_pembayaran' => $totalPembayaran,
        ]);
    
        return redirect()->route('user.detailPemesanan', $pemesanan->id)->with('success', 'Pemesanan berhasil diperbarui!');
    }

    public function getOpenTripQuota($id)
    {
        $openTrip = OpenTrip::findOrFail($id);
        return response()->json(['kuota' => $openTrip->kuota]);
    }


    public function showUploadBuktiPembayaran($id)
    {
        // Find the booking (pemesanan) by ID
        $pemesanan = Pemesanan::with('openTrip', 'privateTrip')->findOrFail($id);
        
        // Check if a payment proof already exists
        $pembayaran = Pembayaran::where('pemesanan_id', $pemesanan->id)->first();
    
        // Return the view with the pemesanan and pembayaran data
        return view('user.pembayaran', compact('pemesanan', 'pembayaran'));
    }
    
    public function uploadBuktiPembayaran(Request $request, $id)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', // Max 10MB
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Find the booking by ID
        $pemesanan = Pemesanan::findOrFail($id);
    
        // Ensure the booking status is confirmed
        if ($pemesanan->status !== 'terkonfirmasi') {
            return back()->withErrors(['status' => 'Hanya pemesanan terkonfirmasi yang dapat mengupload bukti pembayaran.'])->withInput();
        }
    
        // Check if a payment proof already exists
        $pembayaran = Pembayaran::where('pemesanan_id', $pemesanan->id)->first();
    
        // If payment proof exists, check its status
        if ($pembayaran && $pembayaran->status_pembayaran === 'success') {
            return back()->withErrors(['status' => 'Pembayaran telah berhasil dilakukan. Anda tidak dapat mengupload bukti pembayaran lagi.'])->withInput();
        }
    
        // Save the payment proof file
        $file = $request->file('bukti_pembayaran');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('bukti_pembayaran'), $fileName);
    
        if ($pembayaran) {
            // Update existing payment proof
            $pembayaran->update([
                'bukti_pembayaran' => 'bukti_pembayaran/' . $fileName,
                'tanggal_pembayaran' => now(),
                'jumlah_pembayaran' => $pemesanan->total_pembayaran,
                'status_pembayaran' => 'pending', // Set initial status
            ]);
            return redirect()->route('user.detailPemesanan', $pemesanan->id)->with('success', 'Bukti pembayaran berhasil diperbarui!');
        } else {
            // Save new payment proof information in the Pembayaran table
            Pembayaran::create([
                'pemesanan_id' => $pemesanan->id,
                'bukti_pembayaran' => 'bukti_pembayaran/' . $fileName,
                'tanggal_pembayaran' => now(),
                'jumlah_pembayaran' => $pemesanan->total_pembayaran,
                'status_pembayaran' => 'pending', // Set initial status
            ]);
            return redirect()->route('user.detailPemesanan', $pemesanan->id)->with('success', 'Bukti pembayaran berhasil diupload!');
        }
    }

    public function showUploadDataAdministrasi($id)
    {
        // Temukan pemesanan berdasarkan ID
        $pemesanan = Pemesanan::with(['openTrip', 'privateTrip'])->findOrFail($id);
    
        // Pastikan pemesanan sudah terkonfirmasi
        if ($pemesanan->status !== 'terkonfirmasi') {
            return redirect()->route('user.tripsaya')->with('error', 'Hanya pemesanan terkonfirmasi yang dapat mengupload data administrasi.');
        }
    
        // Ambil data administrasi yang sudah ada
        $dataAdministrasi = DataAdministrasi::where('pemesanan_id', $pemesanan->id)->get();
    
        // Kirim variabel ke view
        return view('user.upload-data-administrasi', compact('pemesanan', 'dataAdministrasi'));
    }

    public function storeDataAdministrasi(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'file_dokumen.*' => 'required|file|mimes:pdf,jpg,png,jpeg|max:10240', // Validasi untuk setiap file
        ]);
    
        // Cek status pemesanan
        $pemesanan = Pemesanan::find($validated['pemesanan_id']);
        if ($pemesanan->status !== 'terkonfirmasi') {
            return back()->withErrors(['pemesanan_id' => 'Pemesanan harus terkonfirmasi untuk menambah data administrasi.'])->withInput();
        }
    
        // Loop melalui setiap file yang diupload
        foreach ($request->file('file_dokumen') as $file) {
            // Ambil nama file asli
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            
            // Tambahkan timestamp untuk menghindari konflik nama
            $newFileName = $originalFileName . '_' . time() . '.' . $extension;
    
            // Simpan file dengan nama baru
            $filePath = $file->storeAs('documents', $newFileName, 'public');
    
            // Buat entri baru di DataAdministrasi
            DataAdministrasi::create([
                'pemesanan_id' => $validated['pemesanan_id'],
                'file_dokumen' => $filePath,
                'status' => 'pending', // Initial status
                'user_id' => $pemesanan->user_id, // Get user_id from pemesanan
            ]);
        }
    
      
    
        return redirect()->route('user.tripsaya')->with('success', 'Data Administrasi berhasil ditambahkan');
    }

    public function updateDataAdministrasi(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'selected_documents' => 'array',
            'selected_documents.*' => 'exists:data_administrasi,id',
            'file_dokumen.*' => 'file|mimes:pdf,jpg,png,jpeg|max:10240', // Optional: for new uploads
        ]);
    
        // Check the status of the booking
        $pemesanan = Pemesanan::find($validated['pemesanan_id']);
        if ($pemesanan->status !== 'terkonfirmasi') {
            return back()->withErrors(['pemesanan_id' => 'Pemesanan harus terkonfirmasi untuk memperbarui data administrasi.'])->withInput();
        }
    
        // Update selected documents
        if (!empty($validated['selected_documents'])) {
            foreach ($validated['selected_documents'] as $documentId) {
                $dataAdministrasi = DataAdministrasi::find($documentId);
                // Update logic here, e.g., changing status or other fields
                $dataAdministrasi->status = 'updated'; // Example update
                $dataAdministrasi->save();
            }
        }
    
        // Handle new file uploads if any
        if ($request->hasFile('file_dokumen')) {
            foreach ($request->file('file_dokumen') as $file) {
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $newFileName = $originalFileName . '_' . time() . '.' . $extension;
                $filePath = $file->storeAs('documents', $newFileName, 'public');
    
                DataAdministrasi::create([
                    'pemesanan_id' => $validated['pemesanan_id'],
                    'file_dokumen' => $filePath,
                    'status' => 'pending', // Initial status
                    'user_id' => $pemesanan->user_id,
                ]);
            }
        }
    
        return redirect()->route('user.tripsaya')->with('success', 'Data Administrasi berhasil diperbarui');
    }


}