<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;


class Helper
{
public function fileUpload($file,$path){

   
    $upload = $file ? Storage::disk('s3')->put($path,$file) : null;
    $flepath= "$path"."/".basename(Storage::url($upload));
    return $file ? $flepath : null;
}

public static function instance()
	{
		return new Helper();
	}

}
?>