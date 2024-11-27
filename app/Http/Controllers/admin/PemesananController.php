<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::all();

        return view('pages.admin.pemesanan.index', compact('pemesanans'));
    }
}
