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
    public function home(Request $request)
    {
        $query = OpenTrip::query();
        
        // Search by package name (optional)
        if ($request->filled('search')) {
            $query->where('nama_paket', 'like', '%' . $request->search . '%');
        }
        
        // Filter by destination (optional)
        if ($request->filled('destination') && $request->destination != '*') {
            $query->where('destinasi', $request->destination);
        }
        
        // Filter by duration (optional)
        if ($request->filled('duration') && $request->duration != '*') {
            $query->where('lama_keberangkatan', $request->duration);
        }
        
        // Get the filtered open trips that are not expired
        $open_trips = $query->where(function($q) {
            $q->where('tanggal_berangkat', '>=', now())
              ->orWhere('tanggal_pulang', '>=', now());
        })
        ->orderBy('tanggal_berangkat', 'desc')
        ->orderBy('tanggal_pulang', 'desc')
        ->take(3) // Limit to 3 results for the home page
        ->get();
        
        // Get unique destinations and durations for the search form
        $destinations = OpenTrip::distinct()->pluck('destinasi');
        $durations = OpenTrip::distinct()->pluck('lama_keberangkatan');
        
        // Get the latest articles and order by publish date
        $artikels = Artikel::with('images')
            ->orderBy('tanggal_publish', 'desc') // Order by publish date
            ->take(3) // Limit to 3 results for the home page
            ->get();
        
        return view('home', compact('artikels', 'open_trips', 'destinations', 'durations'));
    }

        // Halaman Open Trip
        public function opentrip(Request $request)
        {
            $query = OpenTrip::query();
            
            // Check if there are search parameters
            if ($request->filled('search') || $request->filled('destination') || $request->filled('duration')) {
                // Search by package name (optional)
                if ($request->filled('search')) {
                    $query->where('nama_paket', 'like', '%' . $request->search . '%');
                }
                
                // Filter by destination (optional)
                if ($request->filled('destination') && $request->destination != '*') {
                    $query->where('destinasi', $request->destination);
                }
                
                // Filter by duration (optional)
                if ($request->filled('duration') && $request->duration != '*') {
                    $query->where('lama_keberangkatan', $request->duration);
                }
            }
            
            // Get the filtered open trips that are not expired
            $open_trips = $query->where(function($q) {
                $q->where('tanggal_berangkat', '>=', now())
                  ->orWhere('tanggal_pulang', '>=', now());
            })
            ->orderBy('tanggal_berangkat', 'desc')
            ->orderBy('tanggal_pulang', 'desc')
            ->paginate(6); // Limit results per page for pagination
            
            // Get unique destinations and durations
            $destinations = OpenTrip::distinct()->pluck('destinasi');
            $durations = OpenTrip::distinct()->pluck('lama_keberangkatan');
            
            // Pass the variables to the view
            return view('opentrip', compact('open_trips', 'destinations', 'durations'));
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
            // Get articles and order by publish date
            $artikels = Artikel::with('images')
                ->orderBy('tanggal_publish', 'desc') // Order by publish date
                ->get(); 
        
            return view('dokumen', compact('artikels'));
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
