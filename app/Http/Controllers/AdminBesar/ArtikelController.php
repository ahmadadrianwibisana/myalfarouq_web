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
        // Validate the request data
        $request->validate([
            'judul_artikel' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_publish' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Create a new article
        $artikel = Artikel::create([
            'judul_artikel' => $request->judul_artikel,
            'deskripsi' => $request->deskripsi,
            'tanggal_publish' => $request->tanggal_publish,
        ]);

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store in 'public/images'
            Image::create([
                'artikel_id' => $artikel->id,
                'image_path' => $imagePath,
            ]);
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
        // Validate the request data
        $request->validate([
            'judul_artikel' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_publish' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Find the article
        $artikel = Artikel::findOrFail($id);
        $artikel->update([
            'judul_artikel' => $request->judul_artikel,
            'deskripsi' => $request->deskripsi,
            'tanggal_publish' => $request->tanggal_publish,
        ]);

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($artikel->images()->exists()) {
                Storage::disk('public')->delete($artikel->images->first()->image_path);
                $artikel->images()->delete();
            }

            $imagePath = $request->file('image')->store('images', 'public');
            Image::create([
                'artikel_id' => $artikel->id,
                'image_path' => $imagePath,
            ]);
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