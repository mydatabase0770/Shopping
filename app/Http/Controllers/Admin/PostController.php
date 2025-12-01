<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::query();

        if (request('search')) {
            $search = request('search');

            $query->where('title', 'LIKE', "%$search%")
                  ->orWhere('price', 'LIKE', "%$search%")
                  ->orWhere('color', 'LIKE', "%$search%")
                  ->orWhere('size', 'LIKE', "%$search%");
        }

        $posts = $query->withCount('categories')->paginate(10);

        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

public function store(PostRequest $request)
{
    $validated = $request->validated();

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('posts', 'public');
    }

    $post = Post::create($validated);

    $post->categories()->sync($request->category_id);

    return redirect()->route('posts.index')
        ->with('success', 'Post created successfully.');
}


    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();   // <---- IMPORTANT

        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, string $id)
    {
        $validated = $request->validated();
        $post = Post::findOrFail($id);

        // image upload
        if ($request->hasFile('image')) {

            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        // sync categories
        if ($request->has('category_id')) {
            $post->categories()->sync($request->category_id);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
