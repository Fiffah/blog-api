<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($postId)
    {
        return Comment::where('post_id', $postId)
            ->with('user')
            ->get();
    }


    public function store(Request $request, $postId)
    {
        $request->validate(['content' => 'required']);

        $comment = Comment::create([
            'post_id' => $postId,
            'user_id' => $request->user()->id,
            'content' => $request->content,
        ]);

        return response()->json($comment, 201);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json(null, 204);
    }
}
