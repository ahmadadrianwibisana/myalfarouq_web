<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\PrivateTrip;

use Illuminate\Http\Request;


class UserController extends Controller
{
    // Method for home page
    public function home()
    {
        return view('user.home');
    }

    // Method for Open Trip page
    public function opentrip()
    {
        return view('user.opentrip');
    }

    // Method for Private Trip page
    public function privatetrip()
    {
        return view('user.privatetrip');
    }

    // Method for Dokumen page
    public function dokumen()
    {
        return view('user.dokumen');
    }

    // Method for Profil Kami page
    public function profilKami()
    {
        return view('user.profil-kami'); // Make sure this view exists
    }

    // Method for Tentang Kami page
    public function tentangKami()
    {
        return view('user.tentang-kami'); // Make sure this view exists
    }

    // Method for Detail page
    public function detail()
    {
        return view('user.detail');  // The view you want to show for the detail page
    }

      // Method for Detail page
    public function detailopen()
    {
        return view('user.detailopen');  // The view you want to show for the detail page
    }

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
    
    


}
