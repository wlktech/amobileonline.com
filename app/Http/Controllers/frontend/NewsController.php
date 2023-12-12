<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function news()
    {
        $posts = Post::all();
        return view('frontend.news.news',compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
       
        $more_news = Post::whereNotIn('id',[$id])->latest()->paginate(4);
        return view('frontend.news.detail',compact('post','more_news'));
    }
}
