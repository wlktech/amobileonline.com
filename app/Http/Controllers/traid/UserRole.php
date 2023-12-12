<?php
namespace App\Http\Controllers\traid;

use Illuminate\Support\Facades\Auth;


trait UserRole
{
   public function isSuperAdmin()
   {
        if(Auth::user()->role == 2){
            return true;
        }else{
            return abort(404);
        }
   }

   public function isStaff()
   {
        if(Auth::user()->role == 1){
            return true;
        }else{
            return abort(404);
        }
   }

   public function user_check($id)
   {
    if(Auth::user()->id == $id){
        return true;
    }else{
        return abort(403);
    }
   }
}

