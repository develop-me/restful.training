<?php

namespace App\Http\Controllers;

use Auth;

use App\Article;
use App\Tag;
use App\Http\Resources\TagResource;
use App\Http\Resources\ArticleListResource;

class Tags extends Controller
{
    public function list()
    {
        $tags = Article::tagsForUser(Auth::user());
        return TagResource::collection($tags);
    }

    public function articles(Tag $tag)
    {
        $articles = $tag->articles->where("user_id", Auth::id());

        return ArticleListResource::collection($articles);
    }
}
