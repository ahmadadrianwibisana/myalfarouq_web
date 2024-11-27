<?php

namespace App\Http\Controllers\AdminBesar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Riwayat;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayats = Riwayat::all();
        return view('pages.adminbesar.riwayat.index', compact('riwayats'));
    }
}
