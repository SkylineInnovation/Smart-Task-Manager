<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // $image => the image file's
    // $mainFile => the file's name location
    // $file => the main file name location
    // $startName => the start name ot the image
    public function apiStoreImage($image, $mainFile, $file = 'image', $startName)
    {
        $folderPath = "images/" . $mainFile . "/";
        $image_parts = explode(";base64,", $image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . $startName . "_" . $file . "_" . uniqid() . '.' . $image_type;
        file_put_contents($file, $image_base64);
        $imageUrl = "/" . $file;
        return $imageUrl;
    }

    // $theImage = (new HomeController)->apiStoreImage($request->image, 'product', 'image', 'product');
    // $imageUrl = (new HomeController)->apiStoreImage($request->image, 'user', 'image');

    public function termsAndConditions()
    {
        return view('stander.terms-and-conditions');
    }
}
