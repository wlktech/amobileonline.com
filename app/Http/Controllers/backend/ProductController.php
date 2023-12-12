<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\traid\UserRole;
use App\Http\Controllers\traid\FileUpload;

class ProductController extends Controller
{
    use UserRole, FileUpload;
    public function index()
    {
        // if($this->isSuperAdmin() || $this->isStaff()){
            $products = Product::with('getProductPhotos')->latest()->paginate(50);
            return view('backend.products.all',compact('products'));
        // }
    }

    public function get_all_products_datatable(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $totalRecords = Product::select('count(*) as allcount')
                        ->where(function ($query) use($searchValue) {
                          $query->where('title', 'like', '%' . $searchValue . '%')
                                ->orWhere('created_at', 'like', '%' . $searchValue . '%');
                        })->count();

        $totalRecordswithFilter = $totalRecords;

        $records = Product::orderBy($columnName, $columnSortOrder)
            ->orderBy('created_at', 'desc')
            ->where(function ($query) use($searchValue) {
              $query->where('title', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%');

            })
            // ->whereBetween('created_at', [$searchByFromdate, $searchByTodate])
            ->select('products.*')
            // ->withTrashed()
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
          $data_arr[] = array(
              "id"=>$record->id,
              "title" => $record->title,
              "image" => $record->OnePhoto->image,
              "price" => $record->price,
              "stock" => $record->stock,
              "count" => $record->counts,
            //   "action" => $record->id,
              "created_at" => $record->created_at,
          );
        }

        $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr,
        );
        echo json_encode($response);
    }
    public function create()
    {
        // if($this->isSuperAdmin() || $this->isStaff()){
        //     return view('backend.products.create');
        // }
        return view('backend.products.create');
    }
    public function store(Request $request)
    {
        if($request->count){
            $request->validate([
                'title' => 'required|max:100',
                'price' => 'required|integer',
                'stock' => 'required',
                'counts' => 'integer',
            ]);
        }else{
            $request->validate([
                'title' => 'required|max:100',
                'price' => 'required|integer',
                'stock' => 'required',

            ]);
        }

        $int_value = (int)$request->price;

        $folderPath = 'images/products/';
        $product = new Product();
        $product->title = $request->title;
        $product->price = $int_value;
        $product->stock = $request->stock;
        if($request->counts){
            $product->counts = $request->counts;
        }else{
            $product->counts = 0;
        }
        $product->cat_id = $request->cat_id;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->save();

        if($request->image){
            foreach($request->image as $re){
                $photo = new ProductPhoto();
                $photo->product_id = $product->id;
                $image_parts = explode(";base64,", $re);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_base64 = base64_decode($image_parts[1]);

                $imageName = uniqid().'_product' . '.png';

                $imageFullPath = public_path($folderPath.$imageName);

                file_put_contents($imageFullPath, $image_base64);
                $photo->image = $folderPath.$imageName;
                $photo->save();

              }
        }
        Session::flash('message', 'Product was created successfully');

        return response()->json([
          'success' => true,
          'message' => "Product Create Success"
        ]);

    }

    public function edit($id)
    {
        // if($this->isSuperAdmin() || $this->isStaff()){
        //     $product = Product::findOrFail($id);
        //     return view('backend.products.edit',compact('product'));
        // }
        $product = Product::findOrFail($id);
        return view('backend.products.edit',compact('product'));

    }

    public function update(Request $request, $id)
    {
        if($request->count){
            $request->validate([
                'title' => 'required|max:100',
                'price' => 'required|integer',
                'stock' => 'required',
                'counts' => 'integer',
            ]);
        }else{
            $request->validate([
                'title' => 'required|max:100',
                'price' => 'required|integer',
                'stock' => 'required',

            ]);
        }

        $folderPath = 'images/products/';
        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->stock = $request->stock;
        if($request->counts){
            $product->counts = $request->counts;
        }else{
            $product->counts = 0;
        }
        $product->cat_id = $request->cat_id;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->save();

        $get_ptroduct_id = ProductPhoto::where('product_id', $product->id)->get();
        if($request->image){

              foreach($get_ptroduct_id as $id){
                if($id->image){
                    if(File::exists(public_path($id->image))){
                       File::delete(public_path($id->image));
                    }

                }
                $id->ForceDelete();
            }

            foreach($request->image as $re){
                $product_photo = new ProductPhoto();
                 $product_photo->product_id = $product->id;
                $image_parts = explode(";base64,", $re);
                $image_type_aux = explode("image/", $image_parts[0]);
                // $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);

                $imageName = uniqid().'_product' . '.png';

                $imageFullPath = public_path($folderPath.$imageName);

                file_put_contents($imageFullPath, $image_base64);
                 $product_photo->image = $folderPath.$imageName;
                 $product_photo->save();


            }
        }
        Session::flash('message', 'Product was updated successfully');

        return response()->json([
          'success' => true,
          'message' => "Product Update Success"
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $photo = ProductPhoto::where('product_id',$product->id)->get();
        foreach($photo as $f){
            $f->delete();
        }

        $product->delete();
        Session::flash('message', 'Product Delete Successfully');
        return redirect()->back();

    }

    public function trash()
    {
        $products = Product::onlyTrashed()->with('getProductPhotos')->get();
        return view('backend.products.trash',compact('products'));
    }

    public function get_all_trashed_datatable(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $totalRecords = Product::select('count(*) as allcount')
                        ->where(function ($query) use($searchValue) {
                          $query->where('title', 'like', '%' . $searchValue . '%')
                                ->orWhere('created_at', 'like', '%' . $searchValue . '%');

                        })->count();

        $totalRecordswithFilter = $totalRecords;

        $records = Product::orderBy($columnName, $columnSortOrder)
            ->orderBy('created_at', 'desc')
            ->where(function ($query) use($searchValue) {
              $query->where('title', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%');

            })
            // ->whereBetween('created_at', [$searchByFromdate, $searchByTodate])
            ->select('products.*')

            ->skip($start)
            ->take($rowperpage)
            ->onlyTrashed()
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
          $data_arr[] = array(
              "id"=>$record->id,
              "title" => $record->title,
            //   "image" => $record->OnePhoto->image,
              "price" => $record->price,
              "stock" => $record->stock,
              "count" => $record->counts,
              "action" => $record->id,
              "created_at" => $record->created_at,
          );
        }

        $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr,
        );
        echo json_encode($response);
    }

    public function restore($id)
    {
        $photo = ProductPhoto::where('product_id',$id)->onlyTrashed()->get();
        foreach($photo as $f){
            $f->restore();
        }
        Product::onlyTrashed()->find($id)->restore();
        Session::flash('message', 'Product was restore Successfully!');
        return redirect(url('store-admin/product/list'));

    }

    public function forceDelete($id)
    {
        $photo = ProductPhoto::where('product_id',$id)->onlyTrashed()->get();
        foreach($photo as $f){
            if($f->image){
                if(File::exists(public_path($f->image))){
                    File::delete(public_path($f->image));
                }

            }
            $f->forceDelete();
        }
        Product::onlyTrashed()->find($id)->forceDelete();
        Session::flash('message', 'Product was deleted success');
        return redirect(url('store-admin/product/list'));
    }

}
