<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $feed = Feed::latest()->with('user')->paginate(2);
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $feed
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'description' => 'required'
        ]);

        $attributes['user_id'] = auth()->id();

        $feed = Feed::create($attributes);

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $feed
        ]);
    }
}
