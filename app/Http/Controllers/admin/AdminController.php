<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\DataAdministrasi;
use App\Models\OpenTrip;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\PrivateTrip;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admins = Admin::count();
        $users = User::count();
        $data_administrasis = DataAdministrasi::count();
        $open_trips = OpenTrip::count();
        $private_trips = PrivateTrip::count();
        $pemesanans = Pemesanan::count();
        $pembayarans = Pembayaran::count();

        return view('pages.admin.index', compact('admins','users', 'data_administrasis','open_trips','private_trips','pemesanans','pembayarans'));
    }

    public function index()
    {
        $admins = Admin::all();
        return view('pages.admin.index', compact('admins'));
    }
}