<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::all();
        if($request->has('search')){
            $posts = Post::where('title', 'like', '%' . $request->search . '%')->get();
        }
        return view('public.public.index', compact('posts'));
    }
}
