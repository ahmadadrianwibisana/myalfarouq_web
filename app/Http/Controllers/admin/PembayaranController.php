<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Riwayat;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('pemesanan')
            ->orderBy('tanggal_pembayaran', 'desc') // Mengurutkan berdasarkan tanggal pembayaran terbaru
            ->paginate(10); // Tambahkan pagination
    
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
    
        // Ambil pemesanan dan periksa total pembayaran
        $pemesanan = Pemesanan::find($request->pemesanan_id);
        if ($pemesanan->total_pembayaran != $request->jumlah_pembayaran) {
            return back()->withErrors(['jumlah_pembayaran' => 'Jumlah pembayaran harus sesuai dengan total pembayaran.'])->withInput();
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
        $pembayaran = Pembayaran::create([
            'pemesanan_id' => $request->pemesanan_id,
            'bukti_pembayaran' => 'bukti_pembayaran/' . $fileName, // Store the relative path in the database
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'status_pembayaran' => 'pending', // Set initial status
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
            'status_pembayaran' => 'required|in:pending,success,failed', // Ensure status is valid
            'alasan_gagal' => 'nullable|string', // Add validation for failure reason
        ]);
    
        // Check if the validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Ambil pemesanan dan periksa total pembayaran
        $pemesanan = Pemesanan::find($request->pemesanan_id);
        if ($pemesanan->total_pembayaran != $request->jumlah_pembayaran) {
            return back()->withErrors(['jumlah_pembayaran' => 'Jumlah pembayaran harus sesuai dengan total pembayaran.'])->withInput();
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
                // Use unlink() for files in public directory
                unlink(public_path($pembayaran->bukti_pembayaran));
            }
    
            // Store the uploaded file
            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Generate a unique file name
            $file->move(public_path('bukti_pembayaran'), $fileName); // Move the file to the desired location
    
            $pembayaran->bukti_pembayaran = 'bukti_pembayaran/' . $fileName; // Update the path in the database
        }
    
        // Update the payment status
        $pembayaran->status_pembayaran = $request->status_pembayaran;

        // If status is failed, save the reason
        if ($request->status_pembayaran === 'failed') {
            $pembayaran->alasan_gagal = $request->alasan_gagal; // Save the failure reason
        } else {
            $pembayaran->alasan_gagal = null; // Clear the reason if not failed
        }
    
        // Save the changes
        $pembayaran->save();
    
        // Set a success message based on the payment status
        switch ($pembayaran->status_pembayaran) {
            case 'pending':
                $message = 'Pembayaran belum dikonfirmasi. Silakan tunggu konfirmasi dari admin.';
                break;
            case 'success':
                $message = 'Pembayaran telah berhasil dilakukan.';
                break;
            default:
                $message = 'Status pembayaran tidak dikenali.';
                break;
        }


        return redirect()->route('admin.pembayaran.index')->with('success', $message); // Use the dynamic message
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