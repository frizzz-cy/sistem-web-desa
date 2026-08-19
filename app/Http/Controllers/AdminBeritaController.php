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

        if (auth()->user()->isAdmin()) {
            $data['is_hidden'] = $request->boolean('is_hidden');
        }

        $data['user_id'] = auth()->id();

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
            $data['foto'] = null;
        } elseif ($request->hasFile('foto')) {
            $data['foto'] = ImageHelper::uploadAndCompress($request->file('foto'), 'berita_images');
        } elseif ($request->filled('foto_media')) {
            $data['foto'] = $request->input('foto_media');
        }

        if (auth()->user()->isAdmin()) {
            $data['is_hidden'] = $request->boolean('is_hidden');
        }

        unset($data['foto_media']);
        $berita->update($data);
        return redirect('/admin/berita')->with('success', 'Berita berhasil diperbarui!');
    }

    // Menghapus berita
    public function destroy(Berita $berita)
    {
        $user = auth()->user();
        if (!$user->isAdmin()) {
            // Kontributor hanya boleh menghapus berita miliknya sendiri
            if (!$berita->user_id || $berita->user_id !== $user->id) {
                return back()->with('error', 'Akses ditolak! Anda tidak berwenang menghapus berita yang dibuat oleh Administrator atau berita resmi desa.');
            }
        }

        // Catatan: Aset foto di Pustaka Media sengaja tidak di-delete dari disk agar tetap aman digunakan modul lain
        $berita->delete();
        return redirect('/admin/berita')->with('success', 'Berita berhasil dihapus!');
    }

    // Toggle Sembunyikan / Tampilkan Berita (Khusus Administrator)
    public function toggleVisibility(Berita $berita)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hanya Administrator Desa yang berwenang mengubah status tayang konten.'
            ], 403);
        }

        $berita->is_hidden = !$berita->is_hidden;
        $berita->save();

        return response()->json([
            'status' => 'success',
            'is_hidden' => (bool)$berita->is_hidden,
            'message' => $berita->is_hidden ? 'Berita berhasil disembunyikan dari publik.' : 'Berita berhasil dipublikasikan kembali.'
        ]);
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
