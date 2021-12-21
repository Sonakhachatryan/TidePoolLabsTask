<?php

namespace FileManager\Services\Validation;

trait Rules
{
    /**
     * Determines whether the field under validation exists and not empty
     *
     * @param  string  $key
     * @return bool|string
     */
    public function required(string $key) : bool|string
    {
        if(isset($_FILES[$key]) && $_FILES[$key]['name'][0]){
            return true;
        }

        if(isset($_REQUEST[$key]) && $_REQUEST[$key]){
            return true;
        }

        return 'This field is required.';
    }

    /**
     * Determines whether the field under validation contains files with given extensions
     *
     * @param  string  $key
     * @param  array  $types
     * @return bool|string
     */
    public function mimes(string $key, array $types) : bool|string
    {
        //if key does not exists return error
        if(isset($_FILES[$key]) && $_FILES[$key]['name'][0]){
            $files = $_FILES[$key];

            foreach ($files['name'] as $filename){
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                //if not in given types return error
                if(!in_array($ext, $types)){
                    return 'Allowed file formats are ' . implode(', ', $types);
                }
            }

            return true;
        }

        return 'Allowed file formats are ' . implode(', ', $types);
    }

    /**
     * Determines whether the field under validation is not bigger then allowed size
     *
     * @param  string  $key
     * @param  array $size
     * @return bool|string
     */
    public function size(string $key, array $size) : bool|string
    {
        $size = $size[0];
        //if key does not exists return error
        if(isset($_FILES[$key]) && $_FILES[$key]['name'][0]){
            $files = $_FILES[$key];

            foreach ($files['size'] as $filesize){
                //if file is bigger the allowed size
                if($filesize > $size){
                    return 'Max allowed file size is '. $size . 'KB';
                }
            }

            return true;
        }

        return 'Max allowed file size is '. $size . 'KB';
    }
}