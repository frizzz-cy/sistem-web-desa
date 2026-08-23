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
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|string',
            'tanggal'    => 'required|date',
            'isi'        => 'required|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg|max:15360',
            'foto_media' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = ImageHelper::uploadAndCompress($request->file('foto'), 'berita_images');
        } elseif ($request->filled('foto_media')) {
            $data['foto'] = $request->input('foto_media');
        }

        unset($data['foto_media']);
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
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|string',
            'tanggal'    => 'required|date',
            'isi'        => 'required|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg|max:15360',
            'foto_media' => 'nullable|string',
        ]);

        if ($request->remove_foto == '1') {
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            $data['foto'] = null;
        } elseif ($request->hasFile('foto')) {
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            $data['foto'] = ImageHelper::uploadAndCompress($request->file('foto'), 'berita_images');
        } elseif ($request->filled('foto_media')) {
            $data['foto'] = $request->input('foto_media');
        }

        unset($data['foto_media']);
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

    // Menangani upload gambar dari editor Quill
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:15360'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = ImageHelper::uploadAndCompress($file, 'berita_content');
            if ($path) {
                return response()->json([
                    'url' => asset('storage/' . $path)
                ]);
            }
        }
        return response()->json(['error' => 'Gagal mengunggah gambar'], 400);
    }
}
