<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Feed;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Thuta Min Thway',
            'email' => 'thuta@gmail.com',
            'password' => bcrypt('password')
        ]);

        Feed::create([
            'user_id' => 1,
            'description' => 'Hello World',
        ]);

        Comment::create([
            'user_id' => 1,
            'feed_id' => 1,
            'comment' => 'This is first comment.'
        ]);

        Like::create([
            'user_id' => 1,
            'feed_id' => 1,
        ]);
    }
}
