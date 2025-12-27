<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\FavCart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Show profile overview
     */
    public function index()
    {
        return view('public.profile.index');
    }

    /**
     * Show edit profile page
     */
    public function edit()
    {
        return view('public.profile.edit');
    }

    /**
     * Store a comment for a post
     */
    public function store(Request $request, int $postId)
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:500'],
        ]);

        Comment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(), // 🔐 secure
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'سەرنجەکەت بە سەرکەوتوویی زیادکرا');
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:225'],
            'email'    => ['required', 'email', 'max:225', 'unique:users,email,' . $user->id],
            'address'  => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', 'min:6'],
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('userprofile.index')
            ->with('success', 'زانیارییەکان بە سەرکەوتوویی نوێ کرانەوە');
    }

public function viewcarts()
{
    $cartsList = FavCart::with('post')
        ->where('user_id', auth()->id())
        ->where('state', FavCart::CART)
        ->get();

    return view('public.profile.viewcarts', compact('cartsList'));
}

public function transactionStore()
{
    $userId = auth()->id();

    $carts = FavCart::with('post')
        ->where('user_id', $userId)
        ->get();

    foreach ($carts as $cart) {
        Transaction::create([
            'user_id' => $userId,
            'post_id' => $cart->post_id,
            'price'   => $cart->post->price,
        ]);
    }

    FavCart::where('user_id', $userId)->delete();

    return redirect()
        ->route('userprofile.index')
        ->with('success', 'کڕین بە سەرکەوتوویی ئەنجام درا');
}

public function removeFromCart($id)
{
    FavCart::where('id', $id)
        ->where('user_id', auth()->id())
        ->delete();

    return back()->with('success', 'کاڵا سڕایەوە');
}


public function destroy()
    {
        $user = auth()->user();

        Auth::logout();
        $user->delete();

        return redirect()->route('login');
    }
}
