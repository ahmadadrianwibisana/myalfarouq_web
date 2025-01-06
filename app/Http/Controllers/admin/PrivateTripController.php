<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivateTrip;
use App\Models\User; // Pastikan Anda mengimpor model User
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;

class PrivateTripController extends Controller
{
    // Display a listing of the private trips
    public function index()
    {
        // Fetch private trips with their related data (joined with 'users' table)
        $private_trips = DB::table('private_trips')
            ->join('users', 'private_trips.user_id', '=', 'users.id')
            ->select('private_trips.*', 'users.name as user_name') // Ambil nama pengguna
            ->orderBy('tanggal_pergi', 'desc') // Mengurutkan berdasarkan tanggal pergi terbaru
            ->orderBy('tanggal_kembali', 'desc') // Mengurutkan berdasarkan tanggal kembali terbaru
            ->paginate(10); // Tambahkan pagination
    
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?'); // Konfirmasi hapus
    
        return view('pages.admin.private_trip.index', compact('private_trips'));
    }

    // Show the form for creating a new private trip
    public function create()
    {
        $users = User::all(['id', 'name', 'no_telepon']); // Ambil id, name, dan no_telepon
        return view('pages.admin.private_trip.create', compact('users'));
    }

    // Store the newly created private trip
// Store the newly created private trip
public function store(Request $request)
{
    // Validasi data yang masuk
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id', // Validasi user_id
        'no_telepon' => 'required|string|max:15',
        'nama_trip' => 'required|string|max:255',
        'destinasi' => 'required|string|max:255',
        'tanggal_pergi' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pergi',
        'star_point' => 'required|string|max:255',
        'jumlah_peserta' => 'required|integer|min:1',
        'deskripsi_trip' => 'required|string',
        'harga' => 'required|numeric|min:0',
        'status' => 'required|in:pending',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
    ]);

    if ($validator->fails()) {
        Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Tangani unggahan gambar jika ada
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('private_trip_images'), $imageName);
    } else {
        $imageName = null;
    }

    // Simpan data trip pribadi
    $privateTrip = PrivateTrip::create([
        'user_id' => $request->user_id, // Simpan user_id
        'no_telepon' => $request->no_telepon,
        'nama_trip' => $request->nama_trip,
        'destinasi' => $request->destinasi,
        'tanggal_pergi' => $request->tanggal_pergi,
        'tanggal_kembali' => $request->tanggal_kembali,
        'star_point' => $request->star_point,
        'jumlah_peserta' => $request->jumlah_peserta,
        'deskripsi_trip' => $request->deskripsi_trip,
        'harga' => $request->harga,
        'status' => $request->status,
        'image' => $imageName,
        'tanggal_pengajuan' => now(), // Set tanggal pengajuan otomatis
        'tanggal_disetujui' => null,  // Set null terlebih dahulu
    ]);

    if ($privateTrip) {
        Alert::success('Sukses!', 'Private Trip telah berhasil ditambahkan!');
        return redirect()->route('admin.private_trip.index');
    } else {
        Alert::error('Gagal!', 'Private Trip gagal ditambahkan!');
        return redirect()->back();
    }
}

     // Fungsi untuk menampilkan detail trip pribadi
    public function show($id)
    {
         // Ambil data trip berdasarkan ID
        $private_trip = DB::table('private_trips')
            ->join('users', 'private_trips.user_id', '=', 'users.id')
            ->select('private_trips.*', 'users.name as user_name', 'users.no_telepon') // Pastikan untuk menambahkan 'description' jika perlu
            ->where('private_trips.id', $id)
            ->first();

        if (!$private_trip) {
            return redirect()->route('admin.private_trip.index')->with('error', 'Trip tidak ditemukan.');
        }
    
        return view('pages.admin.private_trip.show', compact('private_trip'));
    }

    public function edit($id)
{
    $privateTrip = PrivateTrip::findOrFail($id);
    $users = User::all(['id', 'name', 'no_telepon']);
    return view('pages.admin.private_trip.edit', compact('privateTrip', 'users'));
}

public function update(Request $request, $id)
{
    $privateTrip = PrivateTrip::findOrFail($id);

    // Validasi data
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'nama_trip' => 'required|string|max:255',
        'destinasi' => 'required|string|max:255',
        'tanggal_pergi' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pergi',
        'jumlah_peserta' => 'required|integer|min:1',
        'deskripsi_trip' => 'required|string',
        'harga' => 'required|numeric|min:0',
        'status' => 'required|in:pending,disetujui,ditolak',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        'keterangan_ditolak' => $request->status === 'ditolak' ? 'required|string|max:255' : 'nullable',
    ]);

    // Update status dan data terkait
    $privateTrip->status = $validatedData['status'];
    $privateTrip->tanggal_disetujui = $validatedData['status'] === 'disetujui' ? now() : null;
    $privateTrip->keterangan_ditolak = $validatedData['status'] === 'ditolak' ? $validatedData['keterangan_ditolak'] : null;

    // Tangani unggahan gambar jika ada
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('private_trip_images'), $imageName);

        // Hapus gambar lama jika ada
        if ($privateTrip->image) {
            unlink(public_path('private_trip_images/' . $privateTrip->image));
        }

        $privateTrip->image = $imageName;
    }

    // Simpan perubahan
    $privateTrip->save();

    // Cek jika status diubah menjadi 'disetujui'
    if ($validatedData['status'] === 'disetujui') {
        // Buat pemesanan baru
        Pemesanan::create([
            'user_id' => $privateTrip->user_id,
            'trip_type' => 'private_trip',
            'private_trip_id' => $privateTrip->id,
            'tanggal_pemesanan' => now(), // Atur tanggal pemesanan saat ini
            'status' => 'terkonfirmasi', // Status pemesanan
            'total_pembayaran' => $privateTrip->harga, // Total pembayaran
            'jumlah_peserta' => $privateTrip->jumlah_peserta, // Jumlah peserta
            'star_point' => $privateTrip->star_point, // Ambil star_point dari private trip
        ]);
    }

    Alert::success('Sukses!', 'Private Trip telah berhasil diperbarui!');
    return redirect()->route('admin.private_trip.index');
}

public function destroy($id)
{
    // Cari data private trip berdasarkan ID
    $privateTrip = PrivateTrip::findOrFail($id);

    // Hapus gambar lama jika ada
    $oldPath = public_path('private_trip_images/' . $privateTrip->image);
    if (file_exists($oldPath)) {
        unlink($oldPath);
    }

    // Hapus data private trip
    $privateTrip->delete();

    // Berikan respon berdasarkan hasil operasi
    if ($privateTrip) {
        Alert::success('Berhasil!', 'Private Trip berhasil dihapus!');
        return redirect()->route('admin.private_trip.index');
    } else {
        Alert::error('Gagal!', 'Private Trip gagal dihapus!');
        return redirect()->back();
    }
}


}
