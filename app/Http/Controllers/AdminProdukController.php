<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProdukController extends Controller
{
    // Menampilkan daftar produk di tabel admin
    public function index()
    {
        $produks = Produk::latest()->get();
        return view('admin.produk.index', compact('produks'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('admin.produk.create');
    }

    // Menyimpan data produk baru ke database
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk'        => 'required|string|max:255',
            'kategori'           => 'required|string',
            'harga'              => 'required|string',
            'status_stok'        => 'required|string',
            'nama_penjual'       => 'required|string',
            'no_whatsapp'        => 'required|string',
            'deskripsi'          => 'required|string',
            'foto_produk'        => 'nullable|image|mimes:jpeg,png,jpg|max:15360',
            'foto_produk_media'  => 'nullable|string',
        ]);

        if ($request->hasFile('foto_produk')) {
            $data['foto_produk'] = ImageHelper::uploadAndCompress($request->file('foto_produk'), 'produk_images');
        } elseif ($request->filled('foto_produk_media')) {
            $data['foto_produk'] = $request->input('foto_produk_media');
        }

        if (auth()->user()->isAdmin()) {
            $data['is_hidden'] = $request->boolean('is_hidden');
        }

        $data['user_id'] = auth()->id();

        unset($data['foto_produk_media']);
        Produk::create($data);
        return redirect('/admin/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan form edit produk
    public function edit(Produk $produk)
    {
        return view('admin.produk.edit', compact('produk'));
    }

    // Memperbarui data produk
    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'nama_produk'        => 'required|string|max:255',
            'kategori'           => 'required|string',
            'harga'              => 'required|string',
            'status_stok'        => 'required|string',
            'nama_penjual'       => 'required|string',
            'no_whatsapp'        => 'required|string',
            'deskripsi'          => 'required|string',
            'foto_produk'        => 'nullable|image|mimes:jpeg,png,jpg|max:15360',
            'foto_produk_media'  => 'nullable|string',
        ]);

        if ($request->hasFile('foto_produk')) {
            $data['foto_produk'] = ImageHelper::uploadAndCompress($request->file('foto_produk'), 'produk_images');
        } elseif ($request->filled('foto_produk_media')) {
            $data['foto_produk'] = $request->input('foto_produk_media');
        }

        if (auth()->user()->isAdmin()) {
            $data['is_hidden'] = $request->boolean('is_hidden');
        }

        unset($data['foto_produk_media']);
        $produk->update($data);
        return redirect('/admin/produk')->with('success', 'Data produk berhasil diperbarui!');
    }

    // Menghapus produk
    public function destroy(Produk $produk)
    {
        $user = auth()->user();
        if (!$user->isAdmin()) {
            if (!$produk->user_id || $produk->user_id !== $user->id) {
                return back()->with('error', 'Akses ditolak! Anda tidak berwenang menghapus produk yang dibuat oleh Administrator.');
            }
        }

        // Catatan: Aset foto di Pustaka Media sengaja tidak di-delete dari disk agar tetap aman digunakan modul lain
        $produk->delete();
        return redirect('/admin/produk')->with('success', 'Produk berhasil dihapus!');
    }

    // Toggle Sembunyikan / Tampilkan Produk (Khusus Administrator)
    public function toggleVisibility(Produk $produk)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hanya Administrator Desa yang berwenang mengubah status tayang konten.'
            ], 403);
        }

        $produk->is_hidden = !$produk->is_hidden;
        $produk->save();

        return response()->json([
            'status' => 'success',
            'is_hidden' => (bool)$produk->is_hidden,
            'message' => $produk->is_hidden ? 'Produk berhasil disembunyikan dari publik.' : 'Produk berhasil dipublikasikan kembali.'
        ]);
    }
}