<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public function processAndStore(UploadedFile $file, string $directory, int $maxWidth = 1200, int $quality = 85, int $thresholdBytes = 204800, bool $trimTransparent = false): string
    {
        $ext = strtolower($file->getClientOriginalExtension());

        if ($ext === 'ico') {
            $path = "$directory/" . Str::random(40) . '.ico';
            Storage::disk('public')->put($path, $file->get());

            return $path;
        }

        // When trimming is requested we must decode the image even if it is small
        // (to strip transparent borders), so bypass the size-based passthrough.
        if (!$trimTransparent && $file->getSize() <= $thresholdBytes) {
            $path = "$directory/" . Str::random(40) . '.' . $ext;
            Storage::disk('public')->put($path, $file->get());

            return $path;
        }

        if ($trimTransparent) {
            return $this->processWithTrim($file, $directory, $maxWidth, $quality, $ext);
        }

        $image = Image::read($file);

        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $encoded = match ($ext) {
            'png', 'webp' => $image->toWebp(quality: $quality),
            'jpeg', 'jpg' => $image->toJpeg(quality: $quality),
            default => null,
        };

        if ($encoded === null) {
            $path = "$directory/" . Str::random(40) . '.' . $ext;
            Storage::disk('public')->put($path, $file->get());

            return $path;
        }

        $targetExt = in_array($ext, ['png', 'webp']) ? 'webp' : 'jpg';
        $path = "$directory/" . Str::random(40) . '.' . $targetExt;

        Storage::disk('public')->put($path, $encoded);

        return $path;
    }

    public function processFavicon(UploadedFile $file, string $directory, int $maxWidth = 128): string
    {
        $ext = strtolower($file->getClientOriginalExtension());

        if ($ext === 'ico') {
            $path = "$directory/" . Str::random(40) . '.ico';
            Storage::disk('public')->put($path, $file->get());

            return $path;
        }

        $image = @imagecreatefromstring($file->get());

        if ($image === false) {
            $path = "$directory/" . Str::random(40) . '.png';
            Storage::disk('public')->put($path, $file->get());

            return $path;
        }

        $image = $this->trimTransparentBorders($image);

        $width = imagesx($image);
        $height = imagesy($image);

        $size = min($width, $height);
        $cropped = imagecrop($image, [
            'x' => (int) (($width - $size) / 2),
            'y' => (int) (($height - $size) / 2),
            'width' => $size,
            'height' => $size,
        ]);

        if ($cropped !== false) {
            imagedestroy($image);
            $image = $cropped;
        }

        if ($size > $maxWidth) {
            $resized = imagecreatetruecolor($maxWidth, $maxWidth);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $maxWidth, $maxWidth, $size, $size);
            imagedestroy($image);
            $image = $resized;
        }

        imagealphablending($image, false);
        imagesavealpha($image, true);
        ob_start();
        imagepng($image, null, 6);
        $encoded = ob_get_clean();
        imagedestroy($image);

        $path = "$directory/" . Str::random(40) . '.png';
        Storage::disk('public')->put($path, $encoded);

        return $path;
    }

    private function processWithTrim(UploadedFile $file, string $directory, int $maxWidth, int $quality, string $ext): string
    {
        $image = @imagecreatefromstring($file->get());

        if ($image === false) {
            $path = "$directory/" . Str::random(40) . '.' . $ext;
            Storage::disk('public')->put($path, $file->get());

            return $path;
        }

        $image = $this->trimTransparentBorders($image);

        $width = imagesx($image);
        $height = imagesy($image);

        if ($width > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int) round($height * $maxWidth / $width);
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            $image = $resized;
        }

        $targetExt = in_array($ext, ['png', 'webp']) ? 'webp' : 'jpg';

        ob_start();
        if ($targetExt === 'webp') {
            imagealphablending($image, false);
            imagesavealpha($image, true);
            imagewebp($image, null, $quality);
        } else {
            imagejpeg($image, null, $quality);
        }
        $encoded = ob_get_clean();
        imagedestroy($image);

        $path = "$directory/" . Str::random(40) . '.' . $targetExt;
        Storage::disk('public')->put($path, $encoded);

        return $path;
    }

    private function trimTransparentBorders($image)
    {
        $width = imagesx($image);
        $height = imagesy($image);
        $minX = $width;
        $minY = $height;
        $maxX = -1;
        $maxY = -1;

        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $alpha = (imagecolorat($image, $x, $y) >> 24) & 0x7F;
                if ($alpha < 100) {
                    if ($x < $minX) $minX = $x;
                    if ($x > $maxX) $maxX = $x;
                    if ($y < $minY) $minY = $y;
                    if ($y > $maxY) $maxY = $y;
                }
            }
        }

        if ($maxX < $minX) {
            return $image; // fully transparent
        }

        if ($minX === 0 && $minY === 0 && $maxX === $width - 1 && $maxY === $height - 1) {
            return $image; // already tight
        }

        $cropped = imagecrop($image, [
            'x' => $minX,
            'y' => $minY,
            'width' => $maxX - $minX + 1,
            'height' => $maxY - $minY + 1,
        ]);

        if ($cropped === false) {
            return $image;
        }

        imagedestroy($image);

        return $cropped;
    }
}
