<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Transaction;

class Dashboard extends Controller
{
public function index()
{
    $usersCount        = User::count();
    $postsCount        = Post::count();
    $categoriesCount   = Category::count();
    $transactionsCount = Transaction::count();

    $totalRevenue = Transaction::with('post')
        ->get()
        ->sum(fn ($t) => $t->post?->price ?? 0);

    return view('admin.home', compact(
        'usersCount',
        'postsCount',
        'categoriesCount',
        'transactionsCount',
        'totalRevenue'
    ));


}}
