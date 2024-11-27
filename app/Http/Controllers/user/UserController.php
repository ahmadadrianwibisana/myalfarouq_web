<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
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


}
