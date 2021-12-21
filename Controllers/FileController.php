<?php

namespace FileManager\Controllers;

use FileManager\Helper;
use FileManager\Services\File\FileService;
use FileManager\Services\Validation\Validator;

class FileController
{
    protected $validator;
    protected $fileManager;

    /**
     * Create FileController object
     *
     * FileController constructor.
     */
    public function __construct()
    {
        $this->validator = new Validator();
        $this->fileManager = new FileService();
    }

    /**
     * Open main page of the application
     *
     * @return mixed|void
     */
    public function index(): mixed
    {
        $files = [];
        $path = __DIR__.'/../uploads/'.$_SESSION['fileStoragePath'];

        if (file_exists($path)) {
            $files = array_diff(scandir($path), array('.', '..'));;
        }

        return Helper::view('index', ['files' => $files]);
    }

    /**
     * Upload files
     */
    public function upload(): void
    {
        //validate input
        $validationResult = $this->validator->validate([
            'images' =>
                ['required', 'mimes:png,jpeg,jpg', 'size:500000']
        ]);

        if ($validationResult !== true) {
            $_SESSION['errors'] = $validationResult;
            Helper::redirect('/');
        }

        $this->fileManager->uploadFiles();

        Helper::redirect('/');
    }

    /**
     * Delete given file
     */
    public function customize(): void
    {
        //todo add validation rules
        $validationResult = $this->validator->validate([
            'file' => ['required']
        ]);

        if ($validationResult !== true) {
            $_SESSION['errors'] = $validationResult;
            Helper::redirect('/');
        }

        $this->fileManager->customize($_POST);

        Helper::redirect('/');
    }

    /**
     * Delete given file
     */
    public function delete(): void
    {
        $file = $_GET['file'];
        if ($file) {
            $this->fileManager->deleteFile($file);
        }

        Helper::redirect('/');
    }
}