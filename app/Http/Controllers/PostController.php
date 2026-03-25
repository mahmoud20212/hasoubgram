<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        $suggested_users = Auth::user()->suggested_users();
        return view('posts.index', compact('posts', 'suggested_users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
        ]);

        $imagePath = $request->file('image')->store('posts', 'public');
        $data['image'] = $imagePath;
        $data['slug'] = Str::random(10);
        $data['user_id'] = Auth::user()->id;
        
        Post::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        }

        $post->update($data);
        return redirect()->back()->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function explore()
    {
        $posts = Post::whereRelation('owner', 'private_account', '=', 0)->whereNot('user_id', Auth::id())->simplePaginate(12);
        return view('posts.explore', compact('posts'));
    }
}
