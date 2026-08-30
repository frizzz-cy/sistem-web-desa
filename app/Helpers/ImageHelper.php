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
        // 0. Sanitasi folder tujuan dari ancaman Directory Traversal
        $folder = trim(str_replace(['..', '\\', "\0"], '', $folder), '/');

        // 1. Validasi Keamanan Ekstensi & MIME-Type (Mencegah Upload Web Shell / Script PHP)
        $dangerousExtensions = ['php', 'phtml', 'php3', 'php4', 'php5', 'phps', 'phar', 'sh', 'exe', 'cgi', 'pl', 'asp', 'aspx', 'jsp', 'htaccess', 'js', 'html', 'htm'];
        $extension = strtolower((string)$file->getClientOriginalExtension());
        $mimeType = strtolower((string)$file->getMimeType());

        if (in_array($extension, $dangerousExtensions) || !str_starts_with($mimeType, 'image/')) {
            return null; // Tolak unggahan berbahaya
        }

        $filePath = $file->getRealPath();
        if (!$filePath || !file_exists($filePath)) {
            return null;
        }

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
                // Jika ekstensi gambar lain yang valid (misal SVG / ICO)
                $safeName = uniqid('file_', true) . '.' . $extension;
                return $file->storeAs($folder, $safeName, 'public');
        }

        if (!$srcImage) {
            $safeName = uniqid('file_', true) . '.' . $extension;
            return $file->storeAs($folder, $safeName, 'public');
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
