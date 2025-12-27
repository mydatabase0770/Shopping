<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\FavCart;
use App\Models\Post;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()

            /* 🔍 SEARCH */
            ->when(
                $request->filled('search'),
                fn ($q) =>
                    $q->where('title', 'like', '%' . $request->search . '%')
            )

            /* 🗂 CATEGORY FILTER (MANY TO MANY) */
            ->when(
                $request->filled('category'),
                fn ($q) =>
                    $q->whereHas('categories', function ($query) use ($request) {
                        $query->whereIn('categories.id', $request->category);
                    })
            )

            /* 💰 MIN PRICE */
            ->when(
                $request->filled('min_price'),
                fn ($q) =>
                    $q->where('price', '>=', $request->min_price)
            )

            /* 💰 MAX PRICE */
            ->when(
                $request->filled('max_price'),
                fn ($q) =>
                    $q->where('price', '<=', $request->max_price)
            )

            /* 🔥 DISCOUNT ONLY */
            ->when(
                $request->boolean('discount'),
                fn ($q) =>
                    $q->where('discount', '>', 0)
            )

            ->latest()
            ->get();

        /* ❤️ FAVORITES */
        $favorites = auth()->check()
            ? FavCart::where('user_id', auth()->id())
                ->where('state', FavCart::FAVORITE)
                ->get()
            : collect();

        return view('public.public.index', [
            'posts'     => $posts,
            'favorites' => $favorites,
            'favCount'  => $favorites->count(),
        ]);
    }

    /* ================= FAVORITE ================= */

    public function toggleFavorite(Post $post)
    {
        $userId = auth()->id();

        $existing = FavCart::where([
            'user_id' => $userId,
            'post_id' => $post->id,
        ])->first();

        if ($existing && $existing->state === FavCart::FAVORITE) {
            $existing->delete();
        } else {
            FavCart::updateOrCreate(
                [
                    'user_id' => $userId,
                    'post_id' => $post->id,
                ],
                [
                    'state' => FavCart::FAVORITE,
                ]
            );
        }

        return back();
    }

    /* ================= CART ================= */

    public function addToCart(Post $post)
    {
        $userId = auth()->id();

        $existing = FavCart::where([
            'user_id' => $userId,
            'post_id' => $post->id,
        ])->first();

        if ($existing && $existing->state === FavCart::CART) {
            $existing->delete();
        } else {
            FavCart::updateOrCreate(
                [
                    'user_id' => $userId,
                    'post_id' => $post->id,
                ],
                [
                    'state' => FavCart::CART,
                ]
            );
        }

        return back();
    }

    /* ================= DETAIL ================= */

    public function detialpost(Post $post)
    {
        $post->load(['categories', 'comments.user']);

        $inCart = auth()->check() && FavCart::where([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'state'   => FavCart::CART,
        ])->exists();

        return view('public.public.detialpost', compact('post', 'inCart'));
    }
}
