<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\public\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('public', [PublicController::class, 'index'])->name('public.index');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['isadmin'])->group(function () {
        Route::get('/admin/home', [Dashboard::class, 'index'])->name('admin.dashboard');
        Route::resource('users', UserController::class)->names('users');
        Route::resource('categories', CategoryController::class)->names('categories')->except(['show']);
        Route::resource('posts', PostController::class)->names('posts')->except(['show']);
        Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
});
    });




    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
