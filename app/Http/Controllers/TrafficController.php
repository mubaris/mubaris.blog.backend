<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Traffic;

class TrafficController extends Controller
{
    public function index(Request $request)
    {
        $url = $request->query('path');
        $traffic = new Traffic();
        $traffic->url = $url;
        $traffic->save();

        $image_name = "blob.jpg";
        $path = public_path() .'/'. $image_name;

        $im = imagecreate(1, 1);
        $white = imagecolorallocate($im, 255, 255, 255);
        imagesetpixel($im, 1, 1, $white);
        imagejpeg($im, $path);
        imagedestroy($im);
        ob_end_clean();
        return response()->file($path);
    }
}
