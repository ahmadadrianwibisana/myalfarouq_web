<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpenTrip;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;


class OpenTripController extends Controller
{
    public function index()
    {
        $open_trips = OpenTrip::all();
                confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?'); // Konfirmasi hapus product


        return view('pages.admin.open_trip.index', compact('open_trips'));
    }

    public function create()
    {
        return view('pages.admin.open_trip.create'); 
    }

    public function store(Request $request)
{
    // Validasi data yang diterima dari form
    $validator = Validator::make($request->all(), [
        'nama_paket' => 'required|string|max:255',
        'destinasi' => 'required|string|max:255',
        'tanggal_berangkat' => 'required|date',
        'tanggal_pulang' => 'required|date|after_or_equal:tanggal_berangkat',
        'lama_keberangkatan' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
        'kuota' => 'required|integer|min:1',
        'deskripsi_trip' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        'jumlah_peserta' => 'required|integer|min:0',
        'star_point' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Upload gambar jika ada
    // $imagePath = null;
    // if ($request->hasFile('image')) {
    //     $image = $request->file('image');
    //     $imagePath = $image->store('open_trip_images', 'public');
    // }
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('open_trip_images/', $imageName);
    }

    // Simpan data OpenTrip
    $openTrip = OpenTrip::create([
        'nama_paket' => $request->nama_paket,
        'destinasi' => $request->destinasi,
        'tanggal_berangkat' => $request->tanggal_berangkat,
        'tanggal_pulang' => $request->tanggal_pulang,
        'lama_keberangkatan' => $request->lama_keberangkatan,
        'harga' => $request->harga,
        'kuota' => $request->kuota,
        'deskripsi_trip' => $request->deskripsi_trip,
        'image' => $imageName,
        'jumlah_peserta' => $request->jumlah_peserta,
        'star_point' => $request->star_point,
    ]);

    if ($openTrip) {
        Alert::success('Berhasil!', 'Open Trip berhasil ditambahkan!');
        return redirect()->route('admin.open_trip.index');
    } else {
        Alert::error('Gagal!', 'Open Trip gagal ditambahkan!');
        return redirect()->back();
    }
}

        // Function Detail Product
        public function detail($id)
        {
            $open_trips = OpenTrip::findOrFail($id);

    
            return view('pages.admin.open_trip.detail', compact('open_trips'));
        }

    // fungsi edit
    public function edit($id)
{
    $openTrip = OpenTrip::findOrFail($id); // Find the open trip by ID
    return view('pages.admin.open_trip.edit', compact('openTrip')); // Pass the open trip data to the view
}

// fungs updata
public function update(Request $request, $id)
{
    // Validate the incoming data
    $validator = Validator::make($request->all(), [
        'nama_paket' => 'required|string|max:255',
        'destinasi' => 'required|string|max:255',
        'tanggal_berangkat' => 'required|date',
        'tanggal_pulang' => 'required|date|after_or_equal:tanggal_berangkat',
        'lama_keberangkatan' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
        'kuota' => 'required|integer|min:1',
        'deskripsi_trip' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        'jumlah_peserta' => 'required|integer|min:0',
        'star_point' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Find the OpenTrip by ID
    $openTrip = OpenTrip::findOrFail($id);

    // Handle image file if uploaded
    if ($request->hasFile('image')) {
        // Delete old image file if exists
        $oldPath = public_path('open_trip_images/' . $openTrip->image);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        // Store the new image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('open_trip_images/', $imageName);
    } else {
        $imageName = $openTrip->image; // Keep the old image if none is uploaded
    }

    // Update the OpenTrip
    $openTrip->update([
        'nama_paket' => $request->nama_paket,
        'destinasi' => $request->destinasi,
        'tanggal_berangkat' => $request->tanggal_berangkat,
        'tanggal_pulang' => $request->tanggal_pulang,
        'lama_keberangkatan' => $request->lama_keberangkatan,
        'harga' => $request->harga,
        'kuota' => $request->kuota,
        'deskripsi_trip' => $request->deskripsi_trip,
        'image' => $imageName,
        'jumlah_peserta' => $request->jumlah_peserta,
        'star_point' => $request->star_point,
    ]);

    // Check if the update was successful
    if ($openTrip) {
        Alert::success('Berhasil!', 'Open Trip berhasil diperbarui!');
        return redirect()->route('admin.open_trip.index'); // Redirect to open trip index page
    } else {
        Alert::error('Gagal!', 'Open Trip gagal diperbarui!');
        return redirect()->back();
    }
}

    // Function Hapus Open Trip
    public function destroy($id)
    {
        $openTrip = OpenTrip::findOrFail($id);
    
        // Delete the image if it exists
        $oldPath = public_path('open_trip_images/' . $openTrip->image);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }
    
        // Delete the OpenTrip record
        $openTrip->delete();
    
        if ($openTrip) {
            Alert::success('Berhasil!', 'Open Trip berhasil dihapus!');
            return redirect()->route('admin.open_trip');
        } else {
            Alert::error('Gagal!', 'Open Trip gagal dihapus!');
            return redirect()->back();
        }
    }
    



}
