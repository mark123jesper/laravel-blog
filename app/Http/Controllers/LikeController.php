<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function like(Reply $reply)
    {
        $reply->like()->create(
            [
                'user_id' => auth()->id(),
            ]
        );
    }

    public function unlike(Reply $reply)
    {
        $reply->like()->where('user_id', auth()->id())->first()->delete();
    }
}
