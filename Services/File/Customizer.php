<?php

namespace FileManager\Services\File;

trait Customizer
{
    /**
     * Create file object
     *
     * @param  string  $file
     * @param  string  $type
     * @return mixed
     */
    public function createImage(string $file, string $type): mixed
    {
        return match ($type) {
            'jpeg', 'jpg' => imagecreatefromjpeg($file),
            'png' => imagecreatefrompng($file),
        };
    }

    /**
     * Save image after customization
     *
     * @param  string  $filePath
     * @param  string  $type
     */
    public function saveImage(string $filePath, string $type): void
    {
        match ($type) {
            'jpeg', 'jpg' => imagejpeg($this->fileToCustomize, $filePath),
            'png' => imagepng($this->fileToCustomize, $filePath),
        };

        imagedestroy($this->fileToCustomize);
    }

    /**
     * Resize image
     *
     * @param  string  $filePath
     * @param  int  $width
     * @param  int  $height
     */
    public function resize(string $filePath, int $width, int $height): void
    {
        list($sourceWidth, $sourceHeight) = getimagesize($filePath);

        $thumb = imagecreatetruecolor($width, $height);

        imagecopyresized($thumb, $this->fileToCustomize, 0, 0, 0, 0, $width, $height, $sourceWidth, $sourceHeight);

        $this->fileToCustomize = $thumb;
    }

    /**
     * Blur image
     *
     * @param  int  $blur
     */
    public function blur(int $blur): void
    {
        for ($x = 1; $x <= $blur; $x++) {
            imagefilter($this->fileToCustomize, IMG_FILTER_GAUSSIAN_BLUR, 1000);
        }
    }

    /**
     * Change image brightness
     *
     * @param  int  $brightness
     */
    public function brightness(int $brightness): void
    {
        imagefilter($this->fileToCustomize, IMG_FILTER_BRIGHTNESS, $brightness);
    }

    /**
     * Change image brightness
     *
     * @param  int  $grayscale
     */
    public function grayscale(int $grayscale): void
    {
        imagefilter($this->fileToCustomize, IMG_FILTER_GRAYSCALE, $grayscale);
    }
}
