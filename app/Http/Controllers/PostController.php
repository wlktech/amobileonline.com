<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\traid\FileUpload;


class PostController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    $posts = Post::latest()->paginate(1);
       return view('backend.post.all');
    }

    public function get_posts_datatable(request $request)
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
  
        $totalRecords = Post::select('count(*) as allcount')
                        ->where(function ($query) use($searchValue) {
                          $query->where('title', 'like', '%' . $searchValue . '%')
                                ->orWhere('created_at', 'like', '%' . $searchValue . '%');
                                
                        })->count();
                      
        $totalRecordswithFilter = $totalRecords;
  
        $records = Post::orderBy($columnName, $columnSortOrder)
            ->orderBy('created_at', 'desc')
            ->where(function ($query) use($searchValue) {
              $query->where('title', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%');
                
            })
            // ->whereBetween('created_at', [$searchByFromdate, $searchByTodate])
            ->select('post.*')
            // ->withTrashed()
            ->skip($start)
            ->take($rowperpage)
            ->get();
  
        $data_arr = array();
        $id = 1;
        foreach ($records as $record) {
          $data_arr[] = array(
              "id"=>$id++,
              "title" => $record->title,
              "image" => $record->img,
            //   "description" => Str::limit($record->description,50),
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.post.created');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $file_path = "images/posts/";
        $file= $request->file;
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->img = $this->save_file_path($file,$file_path);
        $post->save();
        Session::flash('message', 'Post was created successfully');
        return redirect()->route('store_admin.post.all')->with('success','Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('backend.post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->description = $request->description;
        if($request->file('file')){
            $file_path = "images/posts/";
            $post->img = $this->update_file_path($post->img,$request->file,$file_path);
        }
        $post->update();
        Session::flash('message', 'Post was Updated successfully');

        return redirect()->route('store_admin.post.all')->with('success','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('message', 'Post was deleted successfully');
        return redirect()->back();
    }
}
