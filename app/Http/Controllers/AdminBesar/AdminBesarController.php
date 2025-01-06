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
use RealRashid\SweetAlert\Facades\Alert;


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

    public function showUsersAndAdmins()
    {
        $users = User::paginate(10); // Ambil semua pengguna dengan pagination
        $admins = Admin::paginate(10); // Ambil semua admin dengan pagination
        
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?'); // Konfirmasi hapus
    
        return view('pages.adminbesar.users_and_admins', compact('users', 'admins'));
    }

    public function create()
    {
        return view('pages.adminbesar.create_admin'); // Buat tampilan untuk menambah admin
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username', // Add validation for username
            'email' => 'required|email|unique:admins,email',
            'no_wa' => 'required|string|max:15',
            'password' => 'required|string|min:8|max:20',
        ]);
    
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->username = $request->username; // Set username
        $admin->email = $request->email;
        $admin->no_wa = $request->no_wa;
        $admin->password = bcrypt($request->password);
        $admin->save();
    
        Alert::success('Berhasil!', 'Admin berhasil ditambahkan.'); // Success alert
        return redirect()->route('adminbesar.users_and_admins');

    }
    

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('pages.adminbesar.edit_admin', compact('admin'));
    }
    
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id, // Ensure username is unique except for the current admin
            'email' => 'required|email|unique:admins,email,' . $admin->id, // Ensure email is unique except for the current admin
            'no_wa' => 'required|string|max:15',
        ]);
    
        $admin->name = $request->name;
        $admin->username = $request->username; // Set username
        $admin->email = $request->email;
        $admin->no_wa = $request->no_wa;
        $admin->save();
    
        Alert::success('Berhasil!', 'Admin berhasil diperbarui.'); // Success alert
        return redirect()->route('adminbesar.users_and_admins');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
    
        Alert::success('Berhasil!', 'Admin berhasil dihapus.'); // Success alert
        return redirect()->route('adminbesar.users_and_admins');
    }

}