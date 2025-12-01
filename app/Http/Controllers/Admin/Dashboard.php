<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $postsCount = Post::count();
        $categoriesCount = Category::count();

        return view('admin.home', compact(
            'usersCount',
            'postsCount',
            'categoriesCount'
        ));
    }



}
