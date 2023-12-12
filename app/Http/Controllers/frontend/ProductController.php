<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{


    public function all()
    {
        $products = Product::all();
        return view('frontend.products.all',compact('products'));
    }

    public function all_phone(){
        $products = Product::where('cat_id',1)->get();
        return view('frontend.products.all_phone',compact('products'));
    }

    public function all_laptop(){
        $products = Product::where('cat_id',0)->get();
        return view('frontend.products.all_laptop',compact('products'));
    }

    public function products()
    {
        $products = Product::where('cat_id',1)->latest()->paginate(8);
        $max_price = DB::select(DB::raw('select * from products where price = (select max(`price`) from products)'));
        $ads = Ads::where('page','product')->first();
       
        return view('frontend.products.products',compact('products','max_price','ads'));
    }

    public function products_filter(Request $request)
    {
        $products = Product::whereBetween('price', [$request->min, $request->max])->get();
        return view('frontend.products.filter',compact('products'));
    }

    public function products_search()
    {
        $products = Product::when(isset(request()->search),function($q){
            $search = request()->search;
            $q->orWhere('title',"like","%". $search ."%")->orWhere('price',"like","%". $search ."%");
        })->with(['getProductPhotos'])->latest('id')->paginate(7);
        return view('frontend.products.search',compact('products'));
    }

    public function products_laptop()
    {
        $products = Product::where('cat_id' , 0)->get();
        $product = Product::latest()->paginate(8);
        $ads = Ads::where('page','product')->first();
        return view('frontend.products.product_laptop',compact('products','product','ads'));
    }

    public function product_detail($id)
    {
        $product = Product::findOrFail($id);
        
        $relative_products = Product::where('cat_id',$product->cat_id)->latest()->paginate(4);
        return view('frontend.products.product_detail',compact('product','relative_products'));
    }

    public function buy_now($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($product->OnePhoto->image)){
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "id" => $product->id,
    
                    "name" => $product->title,
    
                    "quantity" =>1,
    
                    "price" => $product->price,
    
                    "image" => $product->OnePhoto->image
    
                ];
    
            }
        }else{
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
    
                    "name" => $product->title,
    
                    "quantity" => 1,
    
                    "price" => $product->price,
    
                    "image" => 'images/assets/default_product.png'
    
                ];
            }
        }
        

        session()->put('cart', $cart);
        return redirect('/billing');
    }

    public function addToCart(Request $request)
    {
       
        $product = Product::findOrFail($request->id);
        $cart = session()->get('cart', []);
        if(isset($product->OnePhoto->image)){
            if(isset($cart[$request->id])) {
                $cart[$request->id]['quantity']++;
            } else {
                $cart[$request->id] = [
                    "id" => $product->id,
    
                    "name" => $product->title,
    
                    "quantity" =>1,
    
                    "price" => $product->price,
    
                    "image" => $product->OnePhoto->image
    
                ];
    
            }
        }else{
            if(isset($cart[$request->id])) {
                $cart[$request->id]['quantity']++;
            } else {
                $cart[$request->id] = [
    
                    "name" => $product->title,
    
                    "quantity" => 1,
    
                    "price" => $product->price,
    
                    "image" => 'images/assets/default_product.png'
    
                ];
    
            }
        }
        

        session()->put('cart', $cart);

    }

    public function addToCartFromProductDetail($id)
    {
       
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($product->OnePhoto->image)){
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "id" => $product->id,
    
                    "name" => $product->title,
    
                    "quantity" =>1,
    
                    "price" => $product->price,
    
                    "image" => $product->OnePhoto->image
    
                ];
    
            }
        }else{
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
    
                    "name" => $product->title,
    
                    "quantity" => 1,
    
                    "price" => $product->price,
    
                    "image" => 'images/assets/default_product.png'
    
                ];
    
            }
        }
        

        session()->put('cart', $cart);
        return redirect()->back();

    }

    public function cart()
    {
        return view('frontend.products.addToCart');
    }

    /**

     * Write code on Method

     *

     * @return response()

     */

     public function update(Request $request)
     {
         if($request->id && $request->quantity){
 
             $cart = session()->get('cart');
 
             $cart[$request->id]["quantity"] = $request->quantity;
 
             session()->put('cart', $cart);
 
             session()->flash('success', 'Cart updated successfully');
 
         }
 
     }
 
   
 
     /**
 
      * Write code on Method
 
      *
 
      * @return response()
 
      */
 
     public function remove(Request $request)
     {
         if($request->id) {
 
             $cart = session()->get('cart');
 
             if(isset($cart[$request->id])) {
 
                 unset($cart[$request->id]);
 
                 session()->put('cart', $cart);
 
             }
 
             session()->flash('success', 'Product removed successfully');
 
         }
 
     }


     public function add_wishlist(Request $request)
     {
       
       if(Auth::check()){
            $wishlist = new Favourite();
            $wishlist->product_id = $request->id;
            $wishlist->user_id = Auth::user()->id;
            $wishlist->save();
       }else{
            $wishlist_session = session()->get('wishlist', []);
            $wishlist_session[$request->id] = $request->id;
            session()->put('wishlist', $wishlist_session);
       }
       return redirect('/products');
     }

     public function remove_wishlist(Request $request)
     {
       
       if(Auth::check()){
            $wishlist_session = session()->get('wishlist');
    
            if(isset($wishlist_session[$request->id])) {

                unset($wishlist_session[$request->id]);

                session()->put('wishlist', $wishlist_session);

            }
            $wishlist = Favourite::where('product_id',$request->id)->where('user_id',Auth::id());
            if($wishlist){
                $wishlist->delete();
            }
           
       }else{
        $wishlist_session = session()->get('wishlist');
 
        if(isset($wishlist_session[$request->id])) {

            unset($wishlist_session[$request->id]);

            session()->put('wishlist', $wishlist_session);

        }

       }
       return redirect('/products');
     }
}
