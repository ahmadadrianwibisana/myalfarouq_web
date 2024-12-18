<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\OpenTrip;
use App\Models\PrivateTrip;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\DataAdministrasi;


class PengunjungController extends Controller
{
    public function home()
    {
        $artikels = Artikel::with('images')->take(3)->get();
        // Mengambil hanya 3 data open trip
        $open_trips = OpenTrip::take(3)->get();  
        return view('home', compact('artikels', 'open_trips'));
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
        
            return view('opentrip', compact('open_trips'));
        }

        // Method for detail open trip
        public function detailopen($id)
        {
            $open_trip = OpenTrip::find($id);
            return view('detailopen', compact('open_trip'));
        }

        // Halaman Artikel
        public function dokumen()
        {
            $artikels = Artikel::with('images')->get(); 
            return view('dokumen',compact('artikels'));
        }
        public function detailArtikel($id)
        {
            $artikel = Artikel::with('images')->find($id);
            return view('detail-artikel', compact('artikel'));
        }

        // Method for Detail page
        public function detail()
        {
            return view('detail');  // The view you want to show for the detail page
        }

        

        // Halaman Privat Trip
        public function privatetrip()
        {
            // Optional: You can pass any additional data to the view if needed
            return view('privatetrip');
        }

    // Halaman Profil Kami
    public function profilKami()
    {
        return view('profil-kami'); // Make sure this view exists
    }



    // Halaman Tentang Kami
    public function tentangKami()
    {
        return view('tentang-kami'); // Make sure this view exists
    }


        

}
