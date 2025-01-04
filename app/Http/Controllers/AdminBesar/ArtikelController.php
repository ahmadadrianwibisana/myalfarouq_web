<?php

namespace App\Http\Controllers\AdminBesar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Image; // Import Image model
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        // Mengambil artikel dan mengurutkannya berdasarkan tanggal_publish terbaru
        $artikels = Artikel::orderBy('tanggal_publish', 'desc')->paginate(10); // Tambahkan pagination
    
        return view('pages.adminbesar.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('pages.adminbesar.artikel.create');
    }

    public function store(Request $request)
    {
        // Validasi data permintaan
        $request->validate([
            'judul_artikel' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_publish' => 'required|date',
            'image.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Ubah validasi untuk array
        ]);
    
        // Buat artikel baru
        $artikel = Artikel::create([
            'judul_artikel' => $request->judul_artikel,
            'deskripsi' => $request->deskripsi,
            'tanggal_publish' => $request->tanggal_publish,
        ]);
    
        // Tangani upload gambar jika ada
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imagePath = $image->store('images', 'public'); // Simpan di 'public/images'
                Image::create([
                    'artikel_id' => $artikel->id,
                    'image_path' => $imagePath,
                ]);
            }
        }
    
        return redirect()->route('adminbesar.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function show($id)
    {
        $artikel = Artikel::with('images')->findOrFail($id); // Load images with the article
        return view('pages.adminbesar.artikel.show', compact('artikel'));
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('pages.adminbesar.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data permintaan
        $request->validate([
            'judul_artikel' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_publish' => 'required|date',
            'image.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Ubah validasi untuk array
        ]);
    
        // Temukan artikel
        $artikel = Artikel::findOrFail($id);
        $artikel->update([
            'judul_artikel' => $request->judul_artikel,
            'deskripsi' => $request->deskripsi,
            'tanggal_publish' => $request->tanggal_publish,
        ]);
    
        // Tangani upload gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($artikel->images()->exists()) {
                foreach ($artikel->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage->image_path);
                }
                $artikel->images()->delete();
            }
    
            foreach ($request->file('image') as $image) {
                $imagePath = $image->store('images', 'public');
                Image::create([
                    'artikel_id' => $artikel->id,
                    'image_path' => $imagePath,
                ]);
            }
        }
    
        return redirect()->route('adminbesar.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        // Delete related images
        if ($artikel->images()->exists()) {
            Storage::disk('public')->delete($artikel->images->first()->image_path);
            $artikel->images()->delete();
        }
        $artikel->delete();

        return redirect()->route('adminbesar.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}