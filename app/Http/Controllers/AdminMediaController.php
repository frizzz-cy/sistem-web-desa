<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMediaController extends Controller
{
    // Menampilkan daftar semua file media
    public function index()
    {
        // Ambil seluruh file di disk public secara rekursif
        $allFiles = Storage::disk('public')->allFiles();
        $images = [];

        foreach ($allFiles as $file) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            // Filter hanya file gambar saja
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                // Kelompokkan folder
                $parts = explode('/', $file);
                $folder = count($parts) > 1 ? $parts[0] : 'umum';

                $images[] = [
                    'path' => $file,
                    'url' => asset('storage/' . $file),
                    'size' => $this->formatBytes(Storage::disk('public')->size($file)),
                    'raw_size' => Storage::disk('public')->size($file),
                    'modified' => Storage::disk('public')->lastModified($file),
                    'folder' => $folder,
                    'name' => basename($file)
                ];
            }
        }

        // Urutkan gambar berdasarkan waktu modifikasi terbaru di atas
        usort($images, function ($a, $b) {
            return $b['modified'] <=> $a['modified'];
        });

        return view('admin.media', compact('images'));
    }

    // Mengunggah file media baru ke folder umum (uploads)
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:15360'
        ]);

        if ($request->hasFile('file')) {
            // Kompresi otomatis menggunakan ImageHelper
            $path = ImageHelper::uploadAndCompress($request->file('file'), 'uploads');
            if ($path) {
                return redirect('/admin/media')->with('success', 'File berhasil diunggah dan dikompresi ke Pustaka Media!');
            }
        }

        return redirect('/admin/media')->with('error', 'Gagal mengunggah berkas media.');
    }

    // Menghapus file media dari disk penyimpanan
    public function destroy(Request $request)
    {
        $path = $request->input('path');

        // Pastikan file ada di public disk (proteksi path traversal)
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return redirect('/admin/media')->with('success', 'Aset media berhasil dihapus secara permanen.');
        }

        return redirect('/admin/media')->with('error', 'Gagal menghapus aset media atau berkas tidak ditemukan.');
    }

    // Helper format ukuran file ke satuan manusiawi
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
