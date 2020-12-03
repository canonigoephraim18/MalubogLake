<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentLikesController extends Controller
{
    public function store(Comment $comment)
    {
        $comment->toggleLike(auth()->user());

        return back();
    }

 
}
