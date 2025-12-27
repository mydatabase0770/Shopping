<?php

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Profile\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\public\PublicController;



Route::get('public', [PublicController::class, 'index'])->name('public.index');

Route::middleware(['auth'])->group(function () {
    Route::post('/favorite/{post}', [PublicController::class, 'toggleFavorite'])
        ->name('addToFavCart');

    Route::post('/cart/{post}', [PublicController::class, 'addToCart'])
        ->name('addToCart');
    Route::delete('/cart/remove/{id}', [UserProfileController::class, 'removeFromCart'])
    ->name('cart.remove');

    Route::get('viewcarts',[UserProfileController::class, 'viewcarts'])->name('viewcarts');
    Route::post('transactionStore',[UserProfileController::class, 'transactionStore'])->name('transactionStore');

    Route::middleware(['isadmin'])->group(function () {
        Route::get('/admin/home', [Dashboard::class, 'index'])->name('admin.dashboard');
        Route::resource('users', UserController::class)->names('users');
        Route::resource('categories', CategoryController::class)->names('categories')->except(['show']);
        Route::resource('posts', PostController::class)->names('posts')->except(['show']);
        Route::resource('transaction', TransactionController::class)->names('transaction')->except(['show','create','store','edit']);
        Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
});
      Route::resource('userprofile', UserProfileController::class)->names('userprofile')->except(['show','create']);
        Route::post('/posts/{post}/comments', [UserProfileController::class, 'store'])
        ->name('comments.store');
    });
Route::get('detialpost/{post}',[PublicController::class, 'detialpost'])->name('detialpost');



    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
