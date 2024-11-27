<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAdministrasi;

class DataAdministrasiController extends Controller
{
    public function index()
    {
        $data_administrasis = DataAdministrasi::all();

        return view('pages.admin.data_administrasi.index', compact( 'data_administrasis'));
    }
}
