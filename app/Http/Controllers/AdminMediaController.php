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
<<<<<<< HEAD
            // Filter hanya file gambar aman (tanpa SVG untuk mencegah embedded script)
=======
            // Filter hanya file gambar raster aman saja (tanpa SVG untuk mencegah inline XSS)
>>>>>>> a174d6d (feat: add media management controller and home page view with routing)
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
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

    // Endpoint JSON untuk Universal Media Picker Modal
    public function apiList()
    {
        $allFiles = Storage::disk('public')->allFiles();
        $images = [];

        foreach ($allFiles as $file) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $parts = explode('/', $file);
                $folder = count($parts) > 1 ? $parts[0] : 'umum';

                $images[] = [
                    'path' => $file,
                    'url' => asset('storage/' . $file),
                    'size' => $this->formatBytes(Storage::disk('public')->size($file)),
                    'modified' => Storage::disk('public')->lastModified($file),
                    'folder' => $folder,
                    'name' => basename($file)
                ];
            }
        }

        usort($images, function ($a, $b) {
            return $b['modified'] <=> $a['modified'];
        });

        return response()->json([
            'status' => 'success',
            'data' => $images
        ]);
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
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'File berhasil diunggah ke Pustaka Media!',
                        'data' => [
                            'path' => $path,
                            'url' => asset('storage/' . $path),
                            'size' => $this->formatBytes(Storage::disk('public')->size($path)),
                            'name' => basename($path),
                            'folder' => 'uploads'
                        ]
                    ]);
                }
                return redirect('/admin/media')->with('success', 'File berhasil diunggah dan dikompresi ke Pustaka Media!');
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengunggah berkas media.'
            ], 422);
        }

        return redirect('/admin/media')->with('error', 'Gagal mengunggah berkas media.');
    }

    // Menghapus file media dari disk penyimpanan dengan proteksi path traversal ketat
    public function destroy(Request $request)
    {
        $rawPath = (string) $request->input('path');

        // Proteksi Path Traversal & karakter terlarang
        if (empty($rawPath) || str_contains($rawPath, '..') || str_contains($rawPath, "\0") || str_starts_with($rawPath, '/') || str_starts_with($rawPath, '\\')) {
            return redirect('/admin/media')->with('error', 'Path berkas tidak valid atau dilarang.');
        }

        $path = ltrim($rawPath, '/');

        // Pastikan hanya file gambar aman yang diizinkan untuk dihapus
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions)) {
            return redirect('/admin/media')->with('error', 'Hanya berkas gambar yang dapat dihapus.');
        }

        // Pastikan file ada di public disk
        if (Storage::disk('public')->exists($path)) {
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
