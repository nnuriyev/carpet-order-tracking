<?php

namespace App\Uploader;

use Illuminate\Support\Facades\Storage;

class FileUploader
{
    public static function upload($input_name, $path, $file_name_prefix = null, $multiple = false)
    {

        if ($multiple === false) {
            $image = request()->file($input_name);
            $ext = $image->guessClientExtension();
            $filename = $file_name_prefix != null ? $file_name_prefix . "_" . uniqid() . ".{$ext}" : "img_" . uniqid() . ".{$ext}";

            $image->storeAs($path, $filename);
            return $path . $filename;
        } else {

            $paths = [];
            $files = request()->file($input_name);
            foreach ($files as $image) {
                $ext = $image->guessClientExtension();
                $filename = $file_name_prefix != null ? $file_name_prefix . "_" . uniqid() . ".{$ext}" : "img_" . uniqid() . ".{$ext}";

                $image->storeAs($path, $filename);
                array_push($paths, $path . $filename);
            }

            return $paths;
        }
    }

    public static function createImageFromBase64($base64File, $path, $fileName, $disc = 'public', $localPath = false)
    {
        $fileFormats = ['jpg', 'jpeg', 'bmp', 'png', 'psd', 'svg'];
        list($type, $base64File) = explode(';', $base64File);
        list(, $format) = explode('/', $type);
        if (!in_array($format, $fileFormats)) return;
        list(, $base64File) = explode(',', $base64File);

        if ($base64File != "") {
            $fileName .= '.' . $format;
            Storage::disk($disc)->put($path . $fileName, base64_decode($base64File));
            return $localPath ? $path . $fileName : Storage::url($path . $fileName);
        }
    }

}
