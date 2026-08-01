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
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = ImageHelper::uploadAndCompress($request->file('foto'), 'kegiatan_images');
        }

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
        ]);

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            $data['foto'] = ImageHelper::uploadAndCompress($request->file('foto'), 'kegiatan_images');
        }

        $kegiatan->update($data);
        return redirect('/admin/kegiatan')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    // Menghapus kegiatan
    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->foto) {
            Storage::disk('public')->delete($kegiatan->foto);
        }
        $kegiatan->delete();
        return redirect('/admin/kegiatan')->with('success', 'Kegiatan berhasil dihapus!');
    }
}
