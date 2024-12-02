<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\Pemesanan;
use App\Models\User;
use App\Models\OpenTrip;
use App\Models\PrivateTrip;
use Illuminate\Validation\Rule;
use App\Models\Riwayat;

class PemesananController extends Controller
{
    // Display the list of Pemesanan (Bookings)
    public function index()
    {   
        $pemesanans = Pemesanan::with([
                'user:id,name',
                'openTrip:id,nama_paket',
                'privateTrip:id,nama_trip'
            ])
            ->get();

            confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?'); // Konfirmasi hapus


        return view('pages.admin.pemesanan.index', compact('pemesanans'));
    }

    // Show the form to create a new Pemesanan
    public function create()
    {
        // Fetch all users, private trips, and open trips
        $users = User::select('id', 'name')->get();
        $privateTrips = PrivateTrip::select('id', 'nama_trip')->where('status', 'disetujui')->get();
        $openTrips = OpenTrip::select('id', 'nama_paket')->get();

        return view('pages.admin.pemesanan.create', compact('users', 'privateTrips', 'openTrips'));
    }

    // Store the new Pemesanan (Booking)
    public function store(Request $request)
{
    // Debugging: Tampilkan semua data yang diterima
    \Log::info('Data yang diterima:', $request->all());
    
    // Validasi data yang masuk
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id',
        'trip_type' => 'required|in:open_trip,private_trip',
        'trip_id' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {
                // Cek tipe trip dan validasi ID
                if ($request->trip_type === 'open_trip') {
                    // Hanya memeriksa ID untuk open_trip tanpa status
                    if (!OpenTrip::where('id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                } elseif ($request->trip_type === 'private_trip') {
                    // Memeriksa ID dan status untuk private_trip
                    if (!PrivateTrip::where('id', $value)->where('status', 'disetujui')->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                }
            },
        ],
        'tanggal_pemesanan' => 'required|date',
    ]);

    if ($validator->fails()) {
        \Log::error('Kesalahan validasi:', $validator->errors()->toArray());
        return back()->withErrors($validator)->withInput();
    }
    
    // Tentukan status berdasarkan jenis trip
    $status = $request->trip_type === 'private_trip' ? 'terkonfirmasi' : 'pending';

    // Calculate total payment
    $totalPembayaran = 0;
    if ($request->trip_type === 'open_trip') {
        $openTrip = OpenTrip::findOrFail($request->trip_id);
        $totalPembayaran = $openTrip->harga * $openTrip->jumlah_peserta; // Use jumlah_peserta from OpenTrip
    } elseif ($request->trip_type === 'private_trip') {
        $privateTrip = PrivateTrip::findOrFail($request->trip_id);
        $totalPembayaran = $privateTrip->harga; // Directly use the price from PrivateTrip
    }

    // Simpan data pemesanan baru ke dalam database
    $pemesanans = Pemesanan::create([
        'user_id' => $request->user_id,
        'trip_type' => $request->trip_type,
        'open_trip_id' => $request->trip_type === 'open_trip' ? $request->trip_id : null,
        'private_trip_id' => $request->trip_type === 'private_trip' ? $request->trip_id : null,
        'tanggal_pemesanan' => $request->tanggal_pemesanan,
        'status' => $status, // Gunakan status yang ditentukan
        'total_pembayaran' => $totalPembayaran, // Save total payment
    ]);

    if ($pemesanans) {
        Alert::success('Berhasil!', 'Pemesanan berhasil ditambahkan!');
        return redirect()->route('admin.pemesanan.index');
    } else {
        Alert::error('Gagal!', 'Pemesanan gagal ditambahkan!');
        return redirect()->back();
    }

}

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip'])->findOrFail($id);
    
        // Check the trip type and get the corresponding details
        $tripDetails = null;
        if ($pemesanan->trip_type === 'open_trip') {
            $tripDetails = $pemesanan->openTrip; // Fetch Open Trip details
        } elseif ($pemesanan->trip_type === 'private_trip') {
            $tripDetails = $pemesanan->privateTrip; // Fetch Private Trip details
        }
    
        return view('pages.admin.pemesanan.show', compact('pemesanan', 'tripDetails'));
    }

    public function edit($id)
    {
        // Fetch the booking along with related user and trip details
        $pemesanan = Pemesanan::with(['user', 'openTrip', 'privateTrip'])->findOrFail($id);
        $users = User::select('id', 'name')->get();
        $privateTrips = PrivateTrip::select('id', 'nama_trip')->get();
        $openTrips = OpenTrip::select('id', 'nama_paket')->get();

        return view('pages.admin.pemesanan.edit', compact('pemesanan', 'users', 'privateTrips', 'openTrips'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'trip_type' => 'required|in:open_trip,private_trip',
            'trip_id' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $model = $request->trip_type === 'open_trip' ? OpenTrip::class : PrivateTrip::class;
                    if (!$model::find($value)) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ],
            'tanggal_pemesanan' => 'required|date',
            'status' => 'required|in:pending,terkonfirmasi,dibatalkan',
            'alasan_batal' => 'nullable|string|max:255', // Validasi untuk alasan batal
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Update the booking
        $pemesanan = Pemesanan::findOrFail($id);

        // Calculate total payment
        $totalPembayaran = 0;
        if ($request->trip_type === 'open_trip') {
            $openTrip = OpenTrip::findOrFail($request->trip_id);
            $totalPembayaran = $openTrip->harga * $openTrip->jumlah_peserta; // Use jumlah_peserta from OpenTrip
        } elseif ($request->trip_type === 'private_trip') {
            $privateTrip = PrivateTrip::findOrFail($request->trip_id);
            $totalPembayaran = $privateTrip->harga; // Directly use the price from PrivateTrip
        }
        // Simpan alasan pembatalan jika status dibatalkan
        $alasan_batal = $request->status === 'dibatalkan' ? $request->alasan_batal : null;
    
        $pemesanan->update([
            'user_id' => $request->user_id,
            'trip_type' => $request->trip_type,
            'open_trip_id' => $request->trip_type === 'open_trip' ? $request->trip_id : null,
            'private_trip_id' => $request->trip_type === 'private_trip' ? $request->trip_id : null,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'status' => $request->status,
            'alasan_batal' => $alasan_batal,
            'total_pembayaran' => $totalPembayaran, // Update total payment
        ]);
    
        // Mengirim pesan WhatsApp jika status terkonfirmasi
        if ($request->status === 'terkonfirmasi') {
            $this->sendWhatsAppMessage($pemesanan->user->no_telepon, $pemesanan->id);
        }
        
    
        Alert::success('Berhasil!', 'Pemesanan berhasil diperbarui!');
        return redirect()->route('admin.pemesanan.index');
    }
    
    // Fungsi untuk mengirim pesan WhatsAppprivate 
    function sendWhatsAppMessage($phoneNumber, $bookingId)
    {
        // Ambil informasi pengguna berdasarkan nomor telepon
        $user = User::where('no_telepon', $phoneNumber)->first();
    
        if ($user) {
            $userName = $user->name;
    
            // Format nomor telepon dalam format internasional
            $formattedPhoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber); // Menghapus karakter non-numerik
            $message = "Halo $userName, pemesanan Anda dengan ID #$bookingId telah terkonfirmasi. Silakan lengkapi data administrasi dan lakukan pembayaran.";
            
            // Encode pesan untuk URL
            $encodedMessage = urlencode($message);
            
            // Membuat URL untuk WhatsApp
            $apiUrl = "https://wa.me/$formattedPhoneNumber?text=$encodedMessage";
            
            // Redirect pengguna ke URL WhatsApp
            header("Location: $apiUrl");
            exit();
        } else {
            echo "Pengguna tidak ditemukan.";
        }
    }
    public function destroy($id)
    {
        // Find the booking by ID
        $pemesanan = Pemesanan::findOrFail($id);

        // Delete the booking
        $pemesanan->delete();

        Alert::success('Berhasil!', 'Pemesanan berhasil dihapus!');
        return redirect()->route('admin.pemesanan.index');
    }

}
