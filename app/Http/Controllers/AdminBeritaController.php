<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBeritaController extends Controller
{
    // Menampilkan daftar berita
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    // Menampilkan form tambah berita
    public function create()
    {
        return view('admin.berita.create');
    }

    // Menyimpan berita baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'isi'      => 'required|string',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = ImageHelper::uploadAndCompress($request->file('foto'), 'berita_images');
        }

        Berita::create($data);
        return redirect('/admin/berita')->with('success', 'Berita berhasil ditambahkan!');
    }

    // Menampilkan form edit berita
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    // Memperbarui berita
    public function update(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'isi'      => 'required|string',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            $data['foto'] = ImageHelper::uploadAndCompress($request->file('foto'), 'berita_images');
        }

        $berita->update($data);
        return redirect('/admin/berita')->with('success', 'Berita berhasil diperbarui!');
    }

    // Menghapus berita
    public function destroy(Berita $berita)
    {
        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }
        $berita->delete();
        return redirect('/admin/berita')->with('success', 'Berita berhasil dihapus!');
    }
}
