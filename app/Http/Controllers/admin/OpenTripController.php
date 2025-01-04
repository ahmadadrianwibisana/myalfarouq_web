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
        $open_trips = OpenTrip::orderBy('tanggal_berangkat', 'desc') // Mengurutkan berdasarkan tanggal berangkat terbaru
            ->orderBy('tanggal_pulang', 'desc') // Mengurutkan berdasarkan tanggal pulang terbaru
            ->paginate(10); // Tambahkan pagination
    
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
            'star_point' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Max 2MB
            'include' => 'nullable|string',
            'exclude' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Handle image file if uploaded
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('open_trip_images/', $imageName);
        }
    
        // Handle file upload if uploaded
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move('open_trip_files/', $fileName);
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
            'star_point' => $request->star_point,
            'file' => $fileName,
            'include' => $request->include,
            'exclude' => $request->exclude,
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
        'star_point' => 'required|string|max:255',
        'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Max 2MB
        ' include' => 'nullable|string',
        'exclude' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Find the OpenTrip by ID
    $openTrip = OpenTrip::findOrFail($id);

    // Handle image file if uploaded
    $imageName = $openTrip->image; // Keep the old image if none is uploaded
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
    }

    // Handle file upload if uploaded
    $fileName = $openTrip->file; // Keep the old file if none is uploaded
    if ($request->hasFile('file')) {
        // Delete old file if exists
        $oldFilePath = public_path('open_trip_files/' . $openTrip->file);
        if (File::exists($oldFilePath)) {
            File::delete($oldFilePath);
        }

        // Store the new file
        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move('open_trip_files/', $fileName);
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
        'star_point' => $request->star_point,
        'file' => $fileName,
        'include' => $request->include,
        'exclude' => $request->exclude,
    ]);

    // Check if the update was successful
    if ($openTrip) {
        Alert::success('Berhasil!', 'Open Trip berhasil diperbarui!');
        return redirect()->route('admin.open_trip.index');
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