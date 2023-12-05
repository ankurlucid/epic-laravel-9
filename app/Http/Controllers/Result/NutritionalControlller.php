<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
class NutritionalControlller extends Controller
{
    public function nutritional(Request $request){
        if($request->date){
            $eventDate =$request->date;
        } else{
            $date = Carbon::now();
            $eventDate = $date->toDateString();
        }
        return view('Result.dailydiary.nutritional',compact('eventDate'));
    }

    public function uploadMealFile(Request $request) {
        // dd( $request->all());
            $iWidth = $request->w;
            $iHeight = $request->h;
            $uploadPath = public_path() . '/uploads/';
            $temp = explode('.', $request->photoName);
            $extension = $temp[1];
            $extension = strtolower($extension);
            $filename = $uploadPath . $request->photoName;
            // $this->correctImageOrientation($filename);
            if ($extension == 'jpg' || $extension == 'jpeg')
                $vImg = @imagecreatefromjpeg($uploadPath . $request->photoName);
            else if ($extension == 'png')
                $vImg = @imagecreatefrompng($uploadPath . $request->photoName);
            else
                @unlink($uploadPath . $request->photoName);

            $vDstImg = @imagecreatetruecolor($iWidth, $iHeight);
            if ($request->widthScale && $request->widthScale != 'Infinity') {
                $x1 = (int) ($request->x1 * $request->widthScale);
                $w = (int) ($request->w * $request->widthScale);
            } else {
                $x1 = (int) $request->x1;
                $w = (int) $request->w;
            }
            if ($request->heightScale && $request->heightScale != 'Infinity') {
                $y1 = (int) ($request->y1 * $request->heightScale);
                $h = (int) ($request->h * $request->heightScale);
            } else {
                $y1 = (int) $request->y1;
                $h = (int) $request->h;
            }
            imagecopyresampled($vDstImg, $vImg, 0, 0, $x1, $y1, $iWidth, $iHeight, $w, $h);
            imagejpeg($vDstImg, $uploadPath . 'thumb_' . $request->photoName, 90);
            $newImage = 'thumb_'.$request->photoName;
            return $newImage;
            // return $request->photoName;
        
    }
}
