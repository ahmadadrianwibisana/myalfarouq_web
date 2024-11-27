<?php

namespace App\Http\Controllers\AdminBesar;

use App\Http\Controllers\Controller;
use App\Models\AdminBesar;
use App\Models\Admin;
use App\Models\User;
use App\Models\Riwayat;
use App\Models\Laporan;
use App\Models\Artikel;
use Illuminate\Http\Request;


class AdminBesarController extends Controller
{
    public function dashboard()
    {
        $admin_besars = AdminBesar::count();
        $admins = Admin::count();
        $users = User::count();
        $riwayats = Riwayat::count();
        $laporans = Laporan::count();
        $artikels = Artikel::count();

        return view('pages.adminbesar.index', compact('admin_besars','admins','users','riwayats','laporans','artikels'));
    }

    public function index()
    {
        $admin_besars = AdminBesar::all();
        return view('pages.adminbesar.index', compact('admin_besars'));
    }
}