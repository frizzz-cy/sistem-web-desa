<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Resize and compress an uploaded image to WebP.
     *
     * @param UploadedFile $file The uploaded file object
     * @param string $folder The destination folder in 'public' disk
     * @param int $maxWidth Maximum width of the image (default: 1000)
     * @param int $quality WebP compression quality (default: 80)
     * @return string|null Path to the saved WebP image relative to the disk root
     */
    public static function uploadAndCompress(UploadedFile $file, string $folder, int $maxWidth = 1000, int $quality = 80): ?string
    {
        // 1. Dapatkan ekstensi asli dan load file ke GD image resource
        $extension = strtolower($file->getClientOriginalExtension());
        $filePath = $file->getRealPath();

        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                $srcImage = @imagecreatefromjpeg($filePath);
                break;
            case 'png':
                $srcImage = @imagecreatefrompng($filePath);
                break;
            case 'gif':
                $srcImage = @imagecreatefromgif($filePath);
                break;
            case 'webp':
                $srcImage = @imagecreatefromwebp($filePath);
                break;
            default:
                // Jika ekstensi tidak didukung GD secara bawaan, simpan biasa
                return $file->store($folder, 'public');
        }

        if (!$srcImage) {
            // Fallback ke penyimpanan biasa jika gagal meload resource
            return $file->store($folder, 'public');
        }

        // 2. Hitung ukuran baru dengan mempertahankan aspect ratio
        list($width, $height) = getimagesize($filePath);
        $newWidth = $width;
        $newHeight = $height;

        if ($width > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int) (($height / $width) * $maxWidth);
        }

        // 3. Buat kanvas gambar kosong baru
        $dstImage = imagecreatetruecolor($newWidth, $newHeight);

        // Pertahankan transparansi (untuk format PNG/WebP transparan)
        imagealphablending($dstImage, false);
        imagesavealpha($dstImage, true);
        
        $transparent = imagecolorallocatealpha($dstImage, 255, 255, 255, 127);
        imagefilledrectangle($dstImage, 0, 0, $newWidth, $newHeight, $transparent);

        // 4. Salin dan resize gambar asli ke kanvas baru
        imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // 5. Generate nama file unik dengan ekstensi .webp
        $filename = uniqid('img_', true) . '.webp';
        $destinationPath = $folder . '/' . $filename;
        
        // Pastikan folder tujuan ada di penyimpanan public
        $fullFolderPath = storage_path('app/public/' . $folder);
        if (!file_exists($fullFolderPath)) {
            mkdir($fullFolderPath, 0755, true);
        }

        $fullDestinationFile = storage_path('app/public/' . $destinationPath);

        // 6. Output gambar GD ke file WebP terkompresi
        $success = imagewebp($dstImage, $fullDestinationFile, $quality);

        // 7. Bersihkan memori GD resource
        imagedestroy($srcImage);
        imagedestroy($dstImage);

        if ($success) {
            return $destinationPath;
        }

        // Fallback jika proses pembuatan WebP gagal
        return $file->store($folder, 'public');
    }
}
