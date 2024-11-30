<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAdministrasi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class DataAdministrasiController extends Controller
{
    public function index()
    {
        $data_administrasis = DataAdministrasi::all();

        return view('pages.admin.data_administrasi.index', compact('data_administrasis'));
    }

    public function create()
    {
        return view('pages.admin.data_administrasi.create'); // Fixed the typo here
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'trip_type' => 'required|in:open_trip,private_trip',
            'user_id' => 'required|exists:users,id',
            'open_trip_id' => 'nullable|exists:open_trips,id',
            'private_trip_id' => 'nullable|exists:private_trips,id',
            'pemesanan_id' => 'required|exists:pemesanan,id',
            'file_dokumen' => 'required|file|mimes:pdf,jpg,png,jpeg|max:10240',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file_dokumen') && $request->file('file_dokumen')->isValid()) {
            $filePath = $request->file('file_dokumen')->store('documents', 'public');
        }

        // Ensure file was successfully uploaded
        if (!$filePath) {
            return back()->withErrors(['file_dokumen' => 'File upload failed or invalid.'])->withInput();
        }

        // Create new DataAdministrasi record
        DataAdministrasi::create([
            'trip_type' => $validated['trip_type'],
            'user_id' => $validated['user_id'],
            'open_trip_id' => $validated['open_trip_id'] ?? null,
            'private_trip_id' => $validated['private_trip_id'] ?? null,
            'pemesanan_id' => $validated['pemesanan_id'],
            'file_dokumen' => $filePath,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.data_administrasi.index')->with('success', 'Data Administrasi berhasil ditambahkan');
    }
}
