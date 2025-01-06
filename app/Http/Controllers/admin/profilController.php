<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class profilController extends Controller
{
    public function show()
    {
        // Get the currently authenticated admin
        $admin = Auth::guard('admin')->user();

        // Return the profile view with the admin data
        return view('pages.admin.profile', compact('admin'));
    }

    public function edit()
    {
        // Get the currently authenticated admin
        $admin = Auth::guard('admin')->user();

        // Return the edit view with the admin data
        return view('pages.admin.edit_profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // Validasi untuk foto
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_wa' => 'required|string|max:15',
            'password' => 'nullable|min:8|max:20', // Ubah menjadi nullable
        ]);
    
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Get the currently authenticated admin
        $admin = Auth::guard('admin')->user();
    
        // Process photo upload if exists
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($admin->foto) {
                $fotoPath = public_path('images/' . $admin->foto);
                if (file_exists($fotoPath)) {
                    unlink($fotoPath); 
                }
            }
    
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension(); 
            $foto->move(public_path('images'), $fotoName); 
            $admin->foto = $fotoName; 
        }
    
        // Update other fields
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->no_wa = $request->no_wa;
    
        // Update password if provided
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }
    
        // Save the admin data
        $admin->save();
    
        Alert::success('Berhasil!', 'Profil admin berhasil diperbarui!');
        return redirect()->route('admin.profile');
    }
}