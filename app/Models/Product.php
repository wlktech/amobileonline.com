<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'title',
        'price',
        'stock',
        'counts',
        'description',
        'specification',
        'cat_id',
        'deleted_at'
    ]; 

    protected $appends = ['OnePhoto'];

    public function getOnePhotoAttribute()
    {
        $photo = ProductPhoto::where('product_id',$this->id)->first();
        return $photo;
    }
    public function getProductPhoto()
    {
        return $this->hasOne(ProductPhoto::class,'product_id');
    }


    public function getProductPhotos()
    {
        return $this->hasMany(ProductPhoto::class,'product_id');
    }


}
