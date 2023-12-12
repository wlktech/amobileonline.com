<?php

namespace App\Http\Controllers\frontend;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        $phones= Product::where('cat_id',1)->paginate(4);
        $laptops = Product::where('cat_id',0)->paginate(4);
        $new_arrival_phones = Product::where('cat_id',1)->latest()->paginate(4);
        $new_arrival_laptops = Product::where('cat_id',0)->latest()->paginate(4);
        $ads = Ads::where('page','home')->first();
        return  view('frontend.index',compact('banner','phones','laptops','new_arrival_phones','new_arrival_laptops','ads'));
    }
}
