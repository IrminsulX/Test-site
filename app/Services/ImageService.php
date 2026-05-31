<?php
namespace App\Services;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\UploadedFile;

class ImageService
{
    public static function resizeAndStore(UploadedFile $file, string $path, int $width = 1200, int $height = null): string
    {
        $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $storedPath = $file->storeAs($path, $filename, 'public');
        $fullPath = storage_path('app/public/' . $storedPath);

        try {
            $img = Image::read($fullPath);
            $img->scaleDown($width, $height ?? $width);
            $img->save($fullPath);
        } catch (\Exception $e) {
            // fallback: store original if resize fails
        }

        return $storedPath;
    }
}
