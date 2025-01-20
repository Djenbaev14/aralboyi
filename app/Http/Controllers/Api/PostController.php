<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\About;
use App\Models\Photo;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Video;
use Request;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::whereNull('deleted_at')->paginate(10));
    }

   
    
    public function show(Post $post)
    {
        $post->increment('views');
        $post = new PostResource(Post::whereNull('deleted_at')->first());

        return response()->json($post);
    }
    public function about(){
        $about=About::first();
        return response()->json($about);
    }
    public function photos(){
        $photos=Photo::get();
        return response()->json($photos);
    }
    public function videos(){
        $videos=Video::get();
        return response()->json($videos);
    }

    
}
