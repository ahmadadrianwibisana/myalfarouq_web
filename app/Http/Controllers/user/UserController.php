<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\OpenTrip;
use App\Models\PrivateTrip;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\DataAdministrasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // Halaman Home
    public function home(Request $request)
    {
        $query = OpenTrip::query();
        $user = Auth::user();

        // Search by package name (optional)
        if ($request->filled('search')) {
            $query->where('nama_paket', 'like', '%' . $request->search . '%');
        }

        // Filter by destination (optional)
        if ($request->filled('destination') && $request->destination != '*') {
            $query->where('destinasi', $request->destination);
        }

        // Filter by duration (optional)
        if ($request->filled('duration') && $request->duration != '*') {
            $query->where('lama_keberangkatan', $request->duration);
        }

        // Get the filtered open trips that are not expired
        $open_trips = $query->where(function($q) {
            $q->where('tanggal_berangkat', '>=', now()) // Only trips that have not started
                ->orWhere('tanggal_pulang', '>=', now()); // Only trips that have not ended
        })
        ->orderBy('tanggal_berangkat', 'desc') // Order by departure date
        ->orderBy('tanggal_pulang', 'desc') // Order by return date
        ->take(3) // Limit to 3 results for the home page
        ->get();

        // Get unique destinations and durations for the search form
        $destinations = OpenTrip::distinct()->pluck('destinasi');
        $durations = OpenTrip::distinct()->pluck('lama_keberangkatan');

        // Get the latest articles and order by publish date
        $artikels = Artikel::with('images')
            ->orderBy('tanggal_publish', 'desc') // Order by publish date
            ->take(3) // Limit to 3 results for the home page
            ->get();

        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

        return view('user.home', compact('artikels', 'open_trips', 'destinations', 'durations', 'pemesanans', 'user'));
    }

    // Halaman Open Trip
    public function opentrip(Request $request)
    {
        $query = OpenTrip::query();

        // Search by package name (optional)
        if ($request->filled('search')) {
            $query->where('nama_paket', 'like', '%' . $request->search . '%');
        }

        // Filter by destination (optional)
        if ($request->filled('destination') && $request->destination != '*') {
            $query->where('destinasi', $request->destination);
        }

        // Filter by duration (optional)
        if ($request->filled('duration') && $request->duration != '*') {
            $query->where('lama_keberangkatan', $request->duration);
        }

        // Get the filtered open trips that are not expired
        $open_trips = $query->where(function($q) {
            $q->where('tanggal_berangkat', '>=', now()) // Only trips that have not started
            ->orWhere('tanggal_pulang', '>=', now()); // Only trips that have not ended
        })
        ->orderBy('tanggal_berangkat', 'desc') // Order by departure date
        ->orderBy('tanggal_pulang', 'desc') // Order by return date
        ->paginate(6); // Limit results per page for pagination

        // Get unique destinations and durations
        $destinations = OpenTrip::distinct()->pluck('destinasi');
        $durations = OpenTrip::distinct()->pluck('lama_keberangkatan');

        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 5
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

        return view('user.opentrip', compact('open_trips', 'destinations', 'durations', 'pemesanans'));
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
            'star_point' => 'required|string|max:255', // Validasi untuk star point
        ]);
    
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan jumlah peserta valid!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            // Temukan open trip berdasarkan ID
            $openTrip = OpenTrip::findOrFail($id);

             // Cek apakah kuota masih tersedia
            if ($openTrip->kuota < $request->jumlah_peserta) {
                Alert::error('Gagal!', 'Kuota open trip sudah habis. Silakan pilih trip lain.');
                return redirect()->back();
            }
        
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
                'star_point' => $request->star_point, // Simpan star point
            ]);


            // Kurangi kuota open trip
            $openTrip->kuota -= $request->jumlah_peserta;
            $openTrip->save();
        
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
        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

        return view('user.detailopen', compact('open_trips','pemesanans'));
    }

    // Halaman Artikel
    public function dokumen()
    {
        // Get articles and order by publish date
        $artikels = Artikel::with('images')
            ->orderBy('tanggal_publish', 'desc') // Order by publish date
            ->get(); 
             // Fetch the authenticated user's bookings with related open trips and private trips
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
        ->where('user_id', auth()->id())
        ->get();
        return view('user.dokumen',compact('artikels','pemesanans'));
    }
    public function detailArtikel($id)
    {
        $artikel = Artikel::with('images')->find($id);
        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

        return view('user.detail-artikel', compact('artikel','pemesanans'));
    }

     // Method for Detail page
    public function detail()
    {
        
         return view('user.detail');  // The view you want to show for the detail page
    }

    // Halaman Privat Trip
    public function privatetrip()
    {
        // Fetch the authenticated user's data
        $user = auth()->user(); // Get the authenticated user

        $privateTrips = PrivateTrip::where('user_id', $user->id)->get(); // Ambil private trip berdasarkan user_id
    
        // Fetch the user's bookings with related open trips and private trips
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();
    
        // Pass the user data to the view
        return view('user.privatetrip', compact('pemesanans', 'user','privateTrips')); // Pass user data to the view
    }

    public function detailPrivateTrip($id)
    {
        $privateTrip = PrivateTrip::findOrFail($id); // Find the private trip by ID
    
        // Fetch the authenticated user's bookings with related open trips and private trips
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();
    
        return view('user.detail-private-trip', compact('privateTrip', 'pemesanans')); // Pass both variables to the view
    }
    public function editPrivateTrip($id)
    {
        $privateTrip = PrivateTrip::findOrFail($id); // Find the private trip by ID
        return view('user.edit-private-trip', compact('privateTrip')); // Return the edit view
    }

    public function updatePrivateTrip(Request $request, $id)
    {
        $privateTrip = PrivateTrip::findOrFail($id); // Find the private trip by ID
    
        // Validate the request
        $request->validate([
            'destinasi' => 'required|string|max:255',
            'tanggal_pergi' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'star_point' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
        ]);
    
        // Update the private trip
        $privateTrip->update($request->all());
    
        return redirect()->route('user.detailPrivateTrip', $privateTrip->id)->with('success', 'Data pengajuan berhasil diperbarui!');
    }

    public function batalPrivateTrip($id)
    {
        $privateTrip = PrivateTrip::findOrFail($id); // Find the private trip by ID

        // Check if the trip belongs to the authenticated user
        if ($privateTrip->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }

        // Delete the private trip
        $privateTrip->delete();

        // Set success message
        return redirect()->route('user.privatetrip')->with('success', 'Pengajuan private trip berhasil dibatalkan!');
    }

    public function createPrivateTrip()
    {
        // Fetch the authenticated user's data
        $user = auth()->user(); // Get the authenticated user

        return view('user.create-private-trip', compact('user')); // Pass user data to the view
    }

    // Halaman Profil Kami
    public function profilKami()
    {
        $user = Auth::user();
        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

    
        return view('user.profil-kami', compact('pemesanans','user')); // Pass pemesanans to the view
    }

    // Halaman Tentang Kami
    public function tentangKami()
    {
        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

    
        return view('user.tentang-kami', compact('pemesanans')); // Pass pemesanans to the view
    }


    // Halaman Trip Saya
    public function tripsaya()
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            Alert::error('Gagal!', 'Anda harus login terlebih dahulu');
            return redirect()->route('login');
        }
    
       // Fetch all bookings for the authenticated user with related open trips and private trips, ordered by booking date
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->orderBy('tanggal_pemesanan', 'desc') // Order by booking date
            ->get(); // Fetch all records


        // Fetch past bookings for the authenticated user
        $riwayat = Pemesanan::with(['openTrip', 'privateTrip'])
        ->where('user_id', auth()->id())
        ->where(function($query) {
            // Include bookings that are confirmed and have passed the trip dates
            $query->where('status', 'terkonfirmasi')
                ->where(function($subQuery) {
                    $subQuery->where('tanggal_pemesanan', '<', now())
                                ->orWhereHas('openTrip', function($q) {
                                    $q->where('tanggal_pulang', '<', now());
                                })
                                ->orWhereHas('privateTrip', function($q) {
                                    $q->where('tanggal_kembali', '<', now());
                                });
                });
        })
        ->orWhere(function($query) {
            // Include canceled bookings
            $query->where('status', 'dibatalkan');
        })
        ->orderBy('tanggal_pemesanan', 'desc') // Order by booking date
        ->get();

        // Fetch limited bookings for the footer (limit to 5 records)
        $footerPemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
        ->where('user_id', auth()->id())
        ->take(5) // Limit to 5 records for the footer
        ->get();

        
        return view('user.tripsaya', compact('pemesanans','footerPemesanans','riwayat'));
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
    
            // Jika pemesanan adalah open trip, kembalikan kuota
            if ($pemesanan->trip_type === 'open_trip') {
                $openTrip = OpenTrip::findOrFail($pemesanan->open_trip_id);
                $openTrip->kuota += $pemesanan->jumlah_peserta; // Kembalikan kuota
                $openTrip->save(); // Simpan perubahan
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

        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

        
        return view('user.detail-pemesanan', compact('pemesanan', 'pembayaran','pemesanans'));
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

        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

    
        return view('user.edit-pemesanan', compact('pemesanan', 'openTrips','pemesanans'));
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
        
        // Get the old and new open trips
        $oldOpenTrip = OpenTrip::findOrFail($pemesanan->open_trip_id);
        $newOpenTrip = OpenTrip::findOrFail($request->open_trip_id);
    
        // Kembalikan kuota open trip yang lama
        if ($pemesanan->trip_type === 'open_trip') {
            $oldOpenTrip->kuota += $pemesanan->jumlah_peserta; // Kembalikan kuota
            $oldOpenTrip->save(); // Simpan perubahan
        }
    
        // Check if the number of participants exceeds the new open trip's quota
        if ($request->jumlah_peserta > $newOpenTrip->kuota) {
            return redirect()->back()->withErrors(['jumlah_peserta' => 'Jumlah peserta tidak boleh lebih dari kuota yang tersedia (' . $newOpenTrip->kuota . ').'])->withInput();
        }
    
        // Hitung total pembayaran
        $totalPembayaran = $newOpenTrip->harga * $request->jumlah_peserta;
    
        // Update the booking
        $pemesanan->update([
            'jumlah_peserta' => $request->jumlah_peserta,
            'open_trip_id' => $request->open_trip_id,
            'total_pembayaran' => $totalPembayaran,
        ]);
    
        // Kurangi kuota open trip yang baru
        $newOpenTrip->kuota -= $request->jumlah_peserta; // Kurangi kuota
        $newOpenTrip->save(); // Simpan perubahan

    
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

        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

    
        // Return the view with the pemesanan and pembayaran data
        return view('user.pembayaran', compact('pemesanan', 'pembayaran','pemesanans'));
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
        
        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

        // Kirim variabel ke view
        return view('user.upload-data-administrasi', compact('pemesanan', 'dataAdministrasi','pemesanans'));
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

    public function someOtherMethod()
    {
        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
            ->where('user_id', auth()->id())
            ->take(5) // Limit to 5 records
            ->get();

        return view('some.view', compact('pemesanans'));
    }


    // Halama Profil User
    public function showProfile()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
        ->where('user_id', auth()->id())
        ->take(5) // Limit to 5 records
        ->get();

        // Kembalikan tampilan profil dengan data pengguna
        return view('user.profile', compact('user','pemesanans'));
    }
    public function editProfile()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Fetch the authenticated user's bookings with related open trips and private trips, limited to 4
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
        ->where('user_id', auth()->id())
        ->take(5) // Limit to 5 records
        ->get();

        // Kembalikan tampilan edit profil dengan data pengguna
        return view('user.edit_profile', compact('user','pemesanans'));
    }

    public function updateProfile(Request $request)
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
    
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // Validasi untuk foto
            'password' => 'nullable|string|min:8|confirmed', // Validasi untuk password baru
            'old_password' => 'required_with:password|string|min:8', // Validasi untuk password lama jika password baru diisi
        ]);
    
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Cek apakah password lama yang dimasukkan benar
        if ($request->filled('password') && !Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Password lama tidak benar.'])->withInput();
        }
    
        // Proses upload foto jika ada
        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($user->image) {
                $imagePath = public_path('images/' . $user->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath); 
                }
            }
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path('images'), $imageName); 
            $user->image = $imageName; 
        }
    
        // Perbarui field lainnya
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telepon = $request->no_telepon;
    
        // Perbarui password jika diisi
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        // Simpan data pengguna
        $user->save();
    
        Alert::success('Berhasil!', 'Profil Anda berhasil diperbarui!');
        return redirect()->route('user.profile');
    }

}