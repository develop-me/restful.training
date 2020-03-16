<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Article;
use App\Comment;
use App\Http\Resources\CommentResource;

class Comments extends Controller
{
    public function list(Article $article)
    {
        return CommentResource::collection($article->comments);
    }

    public function create(CommentRequest $request, Article $article)
    {
        $comment = new Comment($request->only(["email", "comment"]));
        $article->comments()->save($comment);

        return new CommentResource($comment);
    }
}
