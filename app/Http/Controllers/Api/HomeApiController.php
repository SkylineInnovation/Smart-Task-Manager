<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    public static function saveImageApi($data, $folderName)
    {
        try {
            $base64_image = $data;
            $image_image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_image));
            $fileName_image = uniqid() . '.png'; // or any other image format

            $path = storage_path('app/' . $folderName . '/');

            if (!file_exists($path)) mkdir($path, 0777, true);

            $fullPath_image = $path . $fileName_image;
            file_put_contents($fullPath_image, $image_image);

            // $savePath_image = 'images/' . $folderName . '/' . $fileName_image;
            $savePath_image =  $folderName . '/' . $fileName_image;

            return $savePath_image;
        } catch (\Throwable $th) {
            return '';
        }
    }
}
