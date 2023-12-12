<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $table = 'wishlist';
    protected $fillable = ['product_id' , 'user_id'];

    protected $appends = ['Product'];

    public function getProductAttribute()
    {
        $product = Product::where('id',$this->product_id)->first();
        return $product;
    }

}
