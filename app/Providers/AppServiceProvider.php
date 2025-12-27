<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\FavCart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
View::composer('public.layout.publiclayout', function ($view) {

    $favorites = collect();
    $carts = collect();

    if (Auth::check()) {
        $favorites = FavCart::where('user_id', Auth::id())
            ->where('state', FavCart::FAVORITE)->get();

        $carts = FavCart::where('user_id', Auth::id())
            ->where('state', FavCart::CART)->get();
    }

    $view->with([
        'categories' => Category::all(),
        'favorites' => $favorites,
        'favCount' => $favorites->count(),
        'carts' => $carts,
        'cartCount' => $carts->count(),
    ]);
});
    }
}
