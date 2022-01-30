<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/feed', [FeedController::class, 'index']);
    Route::post('/feed/create', [FeedController::class, 'store']);
    Route::post('/comment/create', [CommentController::class, 'store']);
    Route::get('/comment', [CommentController::class, 'index']);
    Route::delete('/comment/delete/{comment}', [CommentController::class, 'delete']);
    Route::post('like', [LikeController::class, 'like']);
    Route::delete('like/delete', [LikeController::class, 'dislike']);
});
