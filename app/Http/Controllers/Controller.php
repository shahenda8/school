<?php

namespace App\Http\Controllers;
use File;

abstract class Controller
{
    //

      public function upload_file($file,$model){
                $extension = $file->getClientOriginalExtension();
                $filename =time(). $file->getClientOriginalName() ;
                $file->move('storage/'.$model.'/', $filename);
                $path = 'storage/'.$model.'/' . $filename;
                return $path;
        }

         public function remove_file($file){
            if($file && $file!=null){
            $f=public_path($file);
            if(File::exists($f)) {
                // dd("dd");
                unlink($f);
                return true;
              }
            }
        }
}
