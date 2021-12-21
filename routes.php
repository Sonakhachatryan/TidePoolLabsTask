<?php
FileManager\Helper::$URL_MATCHED = false;

FileManager\Helper::route('/', \FileManager\Controllers\FileController::class);
FileManager\Helper::route('/file/upload', \FileManager\Controllers\FileController::class, 'upload');
FileManager\Helper::route('/file/customize', \FileManager\Controllers\FileController::class, 'customize');
FileManager\Helper::route('/file/delete', \FileManager\Controllers\FileController::class, 'delete');

if(!FileManager\Helper::$URL_MATCHED){
    http_response_code(404);
    die;
}
