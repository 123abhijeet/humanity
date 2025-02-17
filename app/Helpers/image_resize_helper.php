<?php

namespace App\Helpers;

use Exception;

class image_resize_helper
{
    public static function resizeImage($imagePath, $width, $height)
    {
        list($originalWidth, $originalHeight) = getimagesize($imagePath);
        $newImage = imagecreatetruecolor($width, $height);

        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);

        // Load the original image based on the file extension
        switch ($imageExtension) {
            case 'jpeg':
            case 'jpg':
                $source = imagecreatefromjpeg($imagePath);
                break;
            case 'png':
                $source = imagecreatefrompng($imagePath);
                break;
            case 'gif':
                $source = imagecreatefromgif($imagePath);
                break;
            case 'svg':
                return true; // No need to resize SVG
            default:
                throw new Exception("Unsupported image format.");
        }

        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);

        // Save the resized image based on the file extension
        switch ($imageExtension) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($newImage, $imagePath);
                break;
            case 'png':
                imagepng($newImage, $imagePath);
                break;
            case 'gif':
                imagegif($newImage, $imagePath);
                break;
        }

        // Free up memory
        imagedestroy($newImage);
        imagedestroy($source);

        return true;
    }
}
