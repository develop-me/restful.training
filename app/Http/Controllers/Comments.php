<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Account;
use App\Article;
use App\Comment;

class Comments extends Controller
{
    public function list(Account $account, Article $article)
    {
        return $article->comments;
    }

    public function create(CommentRequest $request, Account $account, Article $article)
    {
        $comment = new Comment($request->only(["email", "comment"]));
        $article->comments()->save($comment);

        return $comment;
    }
}
