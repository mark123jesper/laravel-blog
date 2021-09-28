<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Like;
use App\Models\Question;
use App\Models\Reply;
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
        //!!Order is important!!
        //!!Main Models First!!
        User::factory()->count(10)->create();
        Category::factory()->count(5)->create();

        //!!Model with Foriegn keys must be created last!!
        Question::factory(10)->create();
        Reply::factory(50)->create()->each(function($reply) {
            return $reply->like()->save(Like::factory()->make());
        });
    }
}
