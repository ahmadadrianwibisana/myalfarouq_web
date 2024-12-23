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
use Illuminate\Support\Facades\Log;

class PemesananController extends Controller
{
    // Display the list of Pemesanan (Bookings)
    public function index()
    {   
        $pemesanans = Pemesanan::with([
                'user:id,name',
                'openTrip:id,nama_paket',
                'privateTrip:id,nama_trip',
            ])
            ->orderBy('tanggal_pemesanan', 'desc') // Mengurutkan berdasarkan tanggal pemesanan terbaru
            ->paginate(10); // Tambahkan pagination
    
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?'); // Konfirmasi hapus
    
        return view('pages.admin.pemesanan.index', compact('pemesanans'));
    }

    // Show the form to create a new Pemesanan
    public function create()
    {
        // Fetch all private trips with their associated user
        $privateTrips = PrivateTrip::with('user:id,name')
            ->select('id', 'nama_trip', 'user_id','jumlah_peserta',)
            ->where('status', 'disetujui')
            ->get();
    
        // Fetch all users (kept for flexibility)
        $users = User::select('id', 'name')->get();
        
        // Fetch open trips
        $openTrips = OpenTrip::select('id', 'nama_paket')->get();
    
        return view('pages.admin.pemesanan.create', compact('users', 'privateTrips', 'openTrips'));
    }

    // Store the new Pemesanan (Booking)
    public function store(Request $request)
    {
        // Debugging: Log received data
        Log::info('Data yang diterima:', $request->all());
        
        // Validasi data yang masuk
        $validator = Validator::make($request->all(), [
            'trip_type' => 'required|in:open_trip,private_trip',
            'trip_id' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->trip_type === 'open_trip') {
                        if (!OpenTrip::where('id', $value)->exists()) {
                            $fail("Open Trip tidak valid.");
                        }
                    } elseif ($request->trip_type === 'private_trip') {
                        $privateTrip = PrivateTrip::where('id', $value)
                            ->where('status', 'disetujui')
                            ->first();
                        
                        if (!$privateTrip) {
                            $fail("Private Trip tidak valid atau belum disetujui.");
                        }
                    }
                },
            ],
            'tanggal_pemesanan' => 'required|date',
            'jumlah_peserta' => 'required_if:trip_type,open_trip|integer|min:1', // Validasi hanya untuk open_trip
        ]);
    
        if ($validator->fails()) {
            Log::error('Kesalahan validasi:', $validator->errors()->toArray());
            return back()->withErrors($validator)->withInput();
        }
        
        // Tentukan user_id berdasarkan trip_type
        $user_id = null;
        if ($request->trip_type === 'private_trip') {
            $privateTrip = PrivateTrip::with('user')->findOrFail($request->trip_id);
            if ($privateTrip->user) {
                $user_id = $privateTrip->user_id; // Ambil user_id dari private trip
            } else {
                return back()->withErrors(['trip_id' => 'No user associated with this private trip']);
            }
        } else {
            // Jika trip type adalah open_trip, user_id harus diambil dari input
            $user_id = $request->user_id; // Pastikan user_id diinput untuk open_trip
            $validator->after(function ($validator) use ($user_id) {
                if (empty($user_id)) {
                    $validator->errors()->add('user_id', 'User  ID is required for open trip.');
                }
            });
        }
    
        // Log user_id untuk debugging
        Log::info('User  ID sebelum validasi:', [$user_id]);
    
        // Tentukan status berdasarkan jenis trip
        $status = $request->trip_type === 'private_trip' ? 'terkonfirmasi' : 'pending';
    
        // Hitung total pembayaran
        $totalPembayaran = 0;
        if ($request->trip_type === 'open_trip') {
            $openTrip = OpenTrip::findOrFail($request->trip_id);
            $totalPembayaran = $openTrip->harga * $request->jumlah_peserta; // Gunakan jumlah peserta dari input
        } elseif ($request->trip_type === 'private_trip') {
            $privateTrip = PrivateTrip::findOrFail($request->trip_id);
            $totalPembayaran = $privateTrip->harga;
        }
    
        // Simpan data pemesanan baru ke dalam database
        $pemesanans = Pemesanan::create([
            'user_id' => $user_id,
            'trip_type' => $request->trip_type,
            'open_trip_id' => $request->trip_type === 'open_trip' ? $request->trip_id : null,
            'private_trip_id' => $request->trip_type === 'private_trip' ? $request->trip_id : null,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'status' => $status,
            'total_pembayaran' => $totalPembayaran,
            'tour_gate' => null, // Set tour_gate to null by default
            'jumlah_peserta' => $request->trip_type === 'open_trip' ? $request->jumlah_peserta : null, // Simpan jumlah peserta jika trip_type adalah open_trip
    ]);

    // Jika trip_type adalah private_trip, ambil jumlah peserta dari private trip
    if ($request->trip_type === 'private_trip') {
        $privateTrip = PrivateTrip::findOrFail($request->trip_id);
        $pemesanans->jumlah_peserta = $privateTrip->jumlah_peserta; // Ambil jumlah peserta dari private trip
        $pemesanans->save(); // Simpan perubahan
    }


    // Update kuota open trip
    if ($request->trip_type === 'open_trip') {
        $openTrip = OpenTrip::findOrFail($request->trip_id);
        if ($openTrip->kuota >= $request->jumlah_peserta) {
            $openTrip->kuota -= $request->jumlah_peserta; // Kurangi kuota
            $openTrip->save(); // Simpan perubahan
        } else {
            Alert::error('Gagal!', 'Kuota open trip tidak cukup.');
            return redirect()->back();
        }
    }

    // Cek apakah pemesanan berhasil disimpan
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
    
    // Debugging: Log total pembayaran
    Log::info('Total Pembayaran:', [$pemesanan->total_pembayaran]);

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
        $privateTrips = PrivateTrip::select('id', 'nama_trip')->get();
        $openTrips = OpenTrip::select('id', 'nama_paket')->get();
    
        return view('pages.admin.pemesanan.edit', compact('pemesanan', 'privateTrips', 'openTrips'));
    }
    public function update(Request $request, $id)
    {
        // Fetch the booking
        $pemesanan = Pemesanan::findOrFail($id);
        
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'trip_id' => [
                'required_if:trip_type,open_trip',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->trip_type === 'open_trip') {
                        if (!OpenTrip::find($value)) {
                            $fail("The selected $attribute is invalid.");
                        }
                    }
                },
            ],
            'tanggal_pemesanan' => 'required|date',
            'status' => 'required|in:pending,terkonfirmasi,dibatalkan',
            'alasan_batal' => 'nullable|string|max:255',
            'tour_gate' => 'nullable|string|max:255',
            'jumlah_peserta' => 'required_if:trip_type,open_trip|integer|min:1', // Validasi jumlah peserta
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Save cancellation reason if status is canceled
        $alasan_batal = $request->status === 'dibatalkan' ? $request->alasan_batal : null;
    
        // Hitung total pembayaran berdasarkan trip type
        $totalPembayaran = 0;
        if ($request->trip_type === 'open_trip') {
            $openTrip = OpenTrip::findOrFail($request->trip_id);
            $totalPembayaran = $openTrip->harga * $request->jumlah_peserta; // Hitung total berdasarkan jumlah peserta
        } elseif ($request->trip_type === 'private_trip') {
            $privateTrip = PrivateTrip::findOrFail($request->trip_id);
            $totalPembayaran = $privateTrip->harga;
        }

            // Kembalikan kuota open trip yang lama jika trip_type adalah open_trip
    if ($pemesanan->trip_type === 'open_trip') {
        $oldOpenTrip = OpenTrip::findOrFail($pemesanan->open_trip_id);
        $oldOpenTrip->kuota += $pemesanan->jumlah_peserta; // Kembalikan kuota
        $oldOpenTrip->save(); // Simpan perubahan
    }
    
        // Jika status diubah menjadi dibatalkan
        if ($request->status === 'dibatalkan') {
            if ($pemesanan->trip_type === 'open_trip') {
                $openTrip = OpenTrip::findOrFail($pemesanan->open_trip_id);
                $openTrip->kuota += $pemesanan->jumlah_peserta; // Kembalikan kuota
                $openTrip->save(); // Simpan perubahan
            }
        }
            // Update booking with new data (update trip_id and other details)
        $pemesanan->update([
            'total_pembayaran' => $totalPembayaran, // Update total pembayaran
            'open_trip_id' => $request->trip_type === 'open_trip' ? $request->trip_id : $pemesanan->open_trip_id,
            'private_trip_id' => $request->trip_type === 'private_trip' ? $request->trip_id :  $pemesanan->private_trip_id,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'status' => $request->status,
            'alasan_batal' => $alasan_batal,
            'tour_gate' => $request->tour_gate, // Update tour_gate
            'jumlah_peserta' => $request->trip_type === 'open_trip' ? $request->jumlah_peserta : null, // Update jumlah peserta
        ]);


        // Kurangi kuota open trip yang baru jika trip_type adalah open_trip
        if ($request->trip_type === 'open_trip') {
            $newOpenTrip = OpenTrip::findOrFail($request->trip_id);
            if ($request->jumlah_peserta > $newOpenTrip->kuota) {
                return redirect()->back()->withErrors(['jumlah_peserta' => 'Jumlah peserta tidak boleh lebih dari kuota yang tersedia (' . $newOpenTrip->kuota . ').'])->withInput();
            }
            $newOpenTrip->kuota -= $request->jumlah_peserta; // Kurangi kuota
            $newOpenTrip->save(); // Simpan perubahan
        }
    
        // Cek apakah pemesanan berhasil diperbarui
        if ($pemesanan) {
            // Kirim pesan WhatsApp jika status dikonfirmasi
            if ($request->status === 'terkonfirmasi') {
                $this->sendWhatsAppMessage($pemesanan->user->no_telepon, $pemesanan->id);
            }
    
            Alert::success('Berhasil!', 'Pemesanan berhasil diperbarui!');
            return redirect()->route('admin.pemesanan.index');
        } else {
            Alert::error('Gagal!', 'Pemesanan gagal diperbarui!');
            return redirect()->back();
        }
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

        // Jika pemesanan adalah open trip, kembalikan kuota
        if ($pemesanan->trip_type === 'open_trip') {
            $openTrip = OpenTrip::findOrFail($pemesanan->open_trip_id);
            $openTrip->kuota += $pemesanan->jumlah_peserta; // Kembalikan kuota
            $openTrip->save(); // Simpan perubahan
        }

        // Delete the booking
        $pemesanan->delete();

        Alert::success('Berhasil!', 'Pemesanan berhasil dihapus!');
        return redirect()->route('admin.pemesanan.index');
    }

}
