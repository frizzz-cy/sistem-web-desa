<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKegiatanController extends Controller
{
    // Menampilkan daftar kegiatan
    public function index()
    {
        $kegiatans = Kegiatan::latest()->get();
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    // Menampilkan form tambah kegiatan
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    // Menyimpan kegiatan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'        => 'required|string|max:255',
            'kategori'     => 'required|string',
            'tanggal'      => 'required|date',
            'lokasi'       => 'required|string|max:255',
            'nama_pembuat' => 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg|max:15360',
            'foto_media'   => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = ImageHelper::uploadAndCompress($request->file('foto'), 'kegiatan_images');
        } elseif ($request->filled('foto_media')) {
            $data['foto'] = $request->input('foto_media');
        }

        if (auth()->user()->isAdmin()) {
            $data['is_hidden'] = $request->boolean('is_hidden');
        }

        $data['user_id'] = auth()->id();

        unset($data['foto_media']);
        Kegiatan::create($data);
        return redirect('/admin/kegiatan')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    // Menampilkan form edit kegiatan
    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    // Memperbarui kegiatan
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $data = $request->validate([
            'judul'        => 'required|string|max:255',
            'kategori'     => 'required|string',
            'tanggal'      => 'required|date',
            'lokasi'       => 'required|string|max:255',
            'nama_pembuat' => 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg|max:15360',
            'foto_media'   => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = ImageHelper::uploadAndCompress($request->file('foto'), 'kegiatan_images');
        } elseif ($request->filled('foto_media')) {
            $data['foto'] = $request->input('foto_media');
        }

        if (auth()->user()->isAdmin()) {
            $data['is_hidden'] = $request->boolean('is_hidden');
        }

        unset($data['foto_media']);
        $kegiatan->update($data);
        return redirect('/admin/kegiatan')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    // Menghapus kegiatan
    public function destroy(Kegiatan $kegiatan)
    {
        $user = auth()->user();
        if (!$user->isAdmin()) {
            if (!$kegiatan->user_id || $kegiatan->user_id !== $user->id) {
                return back()->with('error', 'Akses ditolak! Anda tidak berwenang menghapus kegiatan yang dibuat oleh Administrator.');
            }
        }

        // Catatan: Aset foto di Pustaka Media sengaja tidak di-delete dari disk agar tetap aman digunakan modul lain
        $kegiatan->delete();
        return redirect('/admin/kegiatan')->with('success', 'Kegiatan berhasil dihapus!');
    }

    // Toggle Sembunyikan / Tampilkan Kegiatan (Khusus Administrator)
    public function toggleVisibility(Kegiatan $kegiatan)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hanya Administrator Desa yang berwenang mengubah status tayang konten.'
            ], 403);
        }

        $kegiatan->is_hidden = !$kegiatan->is_hidden;
        $kegiatan->save();

        return response()->json([
            'status' => 'success',
            'is_hidden' => (bool)$kegiatan->is_hidden,
            'message' => $kegiatan->is_hidden ? 'Kegiatan berhasil disembunyikan dari publik.' : 'Kegiatan berhasil dipublikasikan kembali.'
        ]);
    }
}
