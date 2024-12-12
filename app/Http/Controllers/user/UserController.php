<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\PrivateTrip;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\OpenTrip;
use App\Models\PrivateTrip;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\Pemesanan;


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
        $pemesanans = Pemesanan::with(['openTrip', 'privateTrip'])
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

<<<<<<< HEAD
     // Method for detail pemesanan
    public function detailPemesanan($id)
    {
        // Temukan pemesanan berdasarkan ID
        $pemesanan = Pemesanan::with(['openTrip', 'privateTrip', 'user'])->findOrFail($id);
        
        return view('user.detail-pemesanan', compact('pemesanan'));
    }
=======
    public function showTripsSaya()
    {
        // Ambil data trip berdasarkan user yang sedang login
        $private_trips = PrivateTrip::where('user_id', auth()->user()->id)->get();

        // Passing data ke view tripsaya
        return view('user.tripsaya', compact('private_trips'));
    }
// -----------------------------------------------------------------------------
    // Method untuk menyimpan data private trip
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_telepon' => 'required|string',
            'nama_trip' => 'required|string',
            'destinasi' => 'required|string',
            'tanggal_pergi' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'star_point' => 'required|string',
            'jumlah_peserta' => 'required|integer',
            'deskripsi_trip' => 'required|string',
        ]);

        // Simpan data ke dalam tabel private_trips
        PrivateTrip::create([
            'no_telepon' => $request->no_telepon,
            'nama_trip' => $request->nama_trip,
            'destinasi' => $request->destinasi,
            'tanggal_pergi' => $request->tanggal_pergi,
            'tanggal_kembali' => $request->tanggal_kembali,
            'star_point' => $request->star_point,
            'jumlah_peserta' => $request->jumlah_peserta,
            'deskripsi_trip' => $request->deskripsi_trip,
        ]);

        // Redirect ke halaman trip saya dengan pesan sukses
        return redirect()->route('user.privatetrip')->with('success', 'Private Trip berhasil disubmit!');
    }

    // Method untuk menampilkan trip saya
    public function tripSaya()
    {
        // Ambil semua data trip yang sudah disubmit
        $privateTrips = PrivateTrip::all();

        // Tampilkan data di halaman trip saya
        return view('user.trip_saya', compact('privateTrips'));
    }
    
    

>>>>>>> 6698e896e4ee9804ef66c5a69f29fa41f7ab645a

}