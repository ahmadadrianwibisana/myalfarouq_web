<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('pemesanan')->get();

        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?'); // Konfirmasi hapus


        return view('pages.admin.pembayaran.index', compact('pembayarans'));
    }
    public function create()
    {
        // Get only pemesanan that are confirmed
        $pemesanans = Pemesanan::where('status', 'terkonfirmasi')->get(); // Filter for confirmed pemesanan
        return view('pages.admin.pembayaran.create', compact('pemesanans'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', // Max 10MB
            'tanggal_pembayaran' => 'required|date',
            'jumlah_pembayaran' => 'required|string',
        ]);
    
        // Check if the validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Check the status of the pemesanan
        $pemesanan = Pemesanan::find($request->pemesanan_id);
        if ($pemesanan->status !== 'terkonfirmasi') {
            return back()->withErrors(['pemesanan_id' => 'Pemesanan harus terkonfirmasi untuk menambah pembayaran.'])->withInput();
        }
    
        // Store the uploaded file directly to public/bukti_pembayaran
        $file = $request->file('bukti_pembayaran');
        $fileName = time() . '_' . $file->getClientOriginalName(); // Generate a unique file name
        $file->move(public_path('bukti_pembayaran'), $fileName); // Move the file to the desired location
    
        // Create a new payment record
        Pembayaran::create([
            'pemesanan_id' => $request->pemesanan_id,
            'bukti_pembayaran' => 'bukti_pembayaran/' . $fileName, // Store the relative path in the database
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
        ]);
    
        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan!');
    }
    public function show($id)
    {
        // Retrieve the payment record by ID with related pemesanan
        $pembayaran = Pembayaran::with('pemesanan.user', 'pemesanan.openTrip', 'pemesanan.privateTrip')->findOrFail($id);
        
        return view('pages.admin.pembayaran.show', compact('pembayaran'));
    }
    public function edit($id)
    {
        // Retrieve the payment record by ID with related pemesanan
        $pembayaran = Pembayaran::with('pemesanan')->findOrFail($id);
        
        // Get only pemesanan that are confirmed
        $pemesanans = Pemesanan::where('status', 'terkonfirmasi')->get(); // Filter for confirmed pemesanan

        return view('pages.admin.pembayaran.edit', compact('pembayaran', 'pemesanans'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240', // Max 10MB
            'tanggal_pembayaran' => 'required|date',
            'jumlah_pembayaran' => 'required|string',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Retrieve the payment record
        $pembayaran = Pembayaran::findOrFail($id);

        // Check the status of the pemesanan
        $pemesanan = Pemesanan::find($request->pemesanan_id);
        if ($pemesanan->status !== 'terkonfirmasi') {
            return back()->withErrors(['pemesanan_id' => 'Pemesanan harus terkonfirmasi untuk mengupdate pembayaran.'])->withInput();
        }

        // Update the payment record
        $pembayaran->pemesanan_id = $request->pemesanan_id;
        $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
        $pembayaran->jumlah_pembayaran = $request->jumlah_pembayaran;

        // Handle file upload if a new file is provided
        if ($request->hasFile('bukti_pembayaran')) {
            // Delete the old file if it exists
            if ($pembayaran->bukti_pembayaran) {
                Storage::delete($pembayaran->bukti_pembayaran);
            }

            // Store the uploaded file
            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Generate a unique file name
            $file->move(public_path('bukti_pembayaran'), $fileName); // Move the file to the desired location

            $pembayaran->bukti_pembayaran = 'bukti_pembayaran/' . $fileName; // Update the path in the database
        }

        // Save the changes
        $pembayaran->save();

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui!');
    }

    public function destroy($id)
{
    // Find the payment record by ID
    $pembayaran = Pembayaran::findOrFail($id);

    // Delete the file if it exists
    if ($pembayaran->bukti_pembayaran) {
        Storage::delete($pembayaran->bukti_pembayaran);
    }

    // Delete the payment record
    $pembayaran->delete();

    return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus!');
}
}