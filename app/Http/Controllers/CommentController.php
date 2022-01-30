<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feed;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store()
    {
        return Comment::create([
            'user_id' => auth()->id(),
            'feed_id' => request('feed_id'),
            'comment' => request('comment')
        ]);
    }

    public function index()
    {
        request()->validate([
            'feed_id' => 'required'
        ]);
        $feed_id = request('feed_id');
        $comments = Feed::find($feed_id)->with('user')->comment;
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $comments
        ]);
    }

    public function delete(Comment $comment)
    {
        return $comment->delete();
    }
}
