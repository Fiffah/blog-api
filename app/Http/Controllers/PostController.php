<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $post = Post::create([
        'title' => $validatedData['title'],
        'content' => $validatedData['content'],
    ]);

    return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
}


    public function show($id)
    {
        return Post::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json(null, 204);
    }
}

