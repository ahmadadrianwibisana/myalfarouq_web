<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::all();

        return view('pages.admin.pembayaran.index', compact('pembayarans'));
    }
}
