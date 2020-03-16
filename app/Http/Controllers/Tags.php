<?php

namespace App\Http\Controllers;

use Auth;

use App\Tag;
use App\Http\Resources\TagResource;
use App\Http\Resources\ArticleListResource;

class Tags extends Controller
{
    public function list()
    {
        $tags = Tag::select("tags.*")->leftJoin("article_tag", "tag_id", "tags.id")
            ->leftJoin("articles", "articles.id", "article_id")
            ->where("articles.user_id", Auth::id())
            ->groupBy("tags.id")
            ->get();

        return TagResource::collection($tags);
    }

    public function articles(Tag $tag)
    {
        $articles = $tag->articles->where("user_id", Auth::id());

        return ArticleListResource::collection($articles);
    }
}
