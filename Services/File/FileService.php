<?php

namespace FileManager\Services\File;

class FileService
{
    use Customizer;

    protected $fileToCustomize = null;

    /**
     * Upload files
     */
    public function uploadFiles(): void
    {
        $filesCount = count($_FILES['images']['name']);

        //create directory if not exists
        $directoryPath = __DIR__.'/../../uploads/'.$_SESSION['fileStoragePath'];
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath);
        }

        //upload files
        for ($i = 0; $i < $filesCount; $i++) {
            $tmpFilePath = $_FILES['images']['tmp_name'][$i];

            if ($tmpFilePath != "") {
                $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                $newFilePath = $directoryPath.'/'.uniqid().'.'.$ext;
                move_uploaded_file($tmpFilePath, $newFilePath);
            }
        }
    }

    /**
     * Get file path
     *
     * @param  string  $file
     * @return string
     */
    public static function getFileUrl(string $file): string
    {
        return '/uploads/'.$_SESSION['fileStoragePath'].'/'.$file;
    }

    /**
     * Customize file
     */
    public function customize(array $data): void
    {
        $filePath = __DIR__.'/../../uploads/'.$_SESSION['fileStoragePath'].'/'.$data['file'];
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);

        //get DGImage object
        $this->fileToCustomize = $this->createImage($filePath, $ext);

        if ($data['width'] && $data['height']) {
            $this->resize($filePath, $data['width'], $data['height']);
        }

        if ($data['blur']) {
            $this->blur($data['blur']);
        }

        if ($data['brightness']) {
            $this->brightness($data['brightness']);
        }

        if ($data['grayscale']) {
            $this->grayscale($data['grayscale']);
        }

        //save DGImage object as file
        $this->saveImage($filePath, $ext);
    }

    /**
     * @param  string  $file
     */
    public function deleteFile(string $file): void
    {
        $filePath = __DIR__.'/../../uploads/'.$_SESSION['fileStoragePath'].'/'.$file;

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}