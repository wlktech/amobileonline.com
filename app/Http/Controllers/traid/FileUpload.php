<?php
namespace App\Http\Controllers\traid;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


trait FileUpload
{
   public function base64_encode($file,$folderPath)
   {
  
        $image_parts = explode(";base64,", $file);
        $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
 
        $imageName = uniqid() . '.png';
 
        $imageFullPath = public_path($folderPath.$imageName);

     
        file_put_contents($imageFullPath, $image_base64);
      

        return $folderPath.$imageName;
    }

    public function save_file_path($file,$file_path)
    {
      $newFileName = uniqid() . '.' . $file->getClientOriginalExtension();
      $file->move(public_path($file_path), $newFileName);
      return $file_path.$newFileName;
    }

    public function update_file_path($file,$update_file,$file_path)
    {
      if(File::exists(public_path($file))){
        File::delete(public_path($file));
      }
      $newFileName = uniqid() . '.' . $update_file->getClientOriginalExtension();
      $update_file->move(public_path($file_path), $newFileName);
      return $file_path.$newFileName;
    }
}