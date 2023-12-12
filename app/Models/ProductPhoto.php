<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPhoto extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'product_photos';
    protected $fillable = ['product_id','image','deleted_at'];
}
