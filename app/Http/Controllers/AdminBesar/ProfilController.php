<?php

namespace App\Http\Controllers\AdminBesar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminBesar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
{
    public function show()
    {
        $adminBesar = Auth::guard('adminbesar')->user();
        return view('pages.adminbesar.profile', compact('adminBesar'));
    }

    public function edit()
    {
        $adminBesar = Auth::guard('adminbesar')->user();
        return view('pages.adminbesar.edit_profile', compact('adminBesar'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|max:20|confirmed',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $adminBesar = Auth::guard('adminbesar')->user();

        // Handle photo upload
        if ($request->hasFile('foto')) {
            if ($adminBesar->foto) {
                $fotoPath = public_path('images/' . $adminBesar->foto);
                if (file_exists($fotoPath)) {
                    unlink($fotoPath);
                }
            }

            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('images'), $fotoName);
            $adminBesar->foto = $fotoName;
        }

        // Update other fields
        $adminBesar->name = $request->name;
        $adminBesar->username = $request->username;
        $adminBesar->email = $request->email;

        if ($request->filled('password')) {
            $adminBesar->password = bcrypt($request->password);
        }

        $adminBesar->save();

        Alert::success('Berhasil!', 'Profil admin besar berhasil diperbarui!');
        return redirect()->route('adminbesar.profile');
    }
}