<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like()
    {
        if (!$this->isLike(auth()->id(), request('feed_id'))) {
            $like = Like::create([
                'user_id' => auth()->id(),
                'feed_id' => request('feed_id')
            ]);
            return response()->json([
                'message' => 'success',
                'status' => 200,
                'data' => $like
            ]);
        }
        return response()->json([
            'message' => 'Fail',
            'status' => 500,
            'data' => "is already Like"
        ]);
    }

    public function disLike()
    {
        $dislike = Like::where('id', request('like_id'))->delete();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $dislike
        ]);
    }

    public function isLike($user_id, $feed_id)
    {
        $like = Like::where('user_id', $user_id)->where('feed_id', $feed_id)->count();
        if ($like) {
            return true;
        }
        return false;
    }
}
