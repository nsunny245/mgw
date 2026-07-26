<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;

class ImageHelper
{
    /**
     * Get the webp version of an image URL/path, converting it if possible.
     */
    public static function webp(?string $path): string
    {
        if (empty($path)) {
            return '';
        }

        // If it's a placeholder image, return it
        if (str_contains($path, 'placehold.co') || str_contains($path, 'unsplash.com') || str_contains($path, 'via.placeholder')) {
            return $path;
        }

        // If it's an absolute URL and not local, we cannot easily convert it
        if (filter_var($path, FILTER_VALIDATE_URL) && !str_starts_with($path, url('/'))) {
            return $path;
        }

        // Convert full URL to relative path if it starts with the app URL
        $relative = $path;
        if (str_starts_with($path, url('/'))) {
            $relative = str_replace(url('/'), '', $path);
        }
        $relative = ltrim($relative, '/');

        // Check if file is already WebP
        if (strtolower(pathinfo($relative, PATHINFO_EXTENSION)) === 'webp') {
            return $path;
        }

        // Determine local file path
        $localPath = public_path($relative);

        // If it's in storage, resolve local path properly
        if (str_starts_with($relative, 'storage/')) {
            $storageRelative = str_replace('storage/', '', $relative);
            $localPath = storage_path('app/public/' . $storageRelative);
        }

        if (!file_exists($localPath)) {
            return $path;
        }

        // Get output path
        $webpLocalPath = preg_replace('/\.[^.]+$/', '.webp', $localPath);
        $webpUrlPath = preg_replace('/\.[^.]+$/', '.webp', $path);

        // If WebP version already exists, return it
        if (file_exists($webpLocalPath)) {
            return $webpUrlPath;
        }

        // Otherwise, attempt to convert it
        if (!function_exists('imagewebp')) {
            // WebP conversion is not supported on this server/environment, fallback to original
            return $path;
        }

        try {
            $manager = ImageManager::gd();
            $image = $manager->read($localPath);
            $image->toWebp(85)->save($webpLocalPath);
            return $webpUrlPath;
        } catch (\Exception $e) {
            // Log or ignore, return original path on failure
            logger('WebP conversion failed for ' . $localPath . ': ' . $e->getMessage());
            return $path;
        }
    }
}
