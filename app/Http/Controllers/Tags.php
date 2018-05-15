<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Tag;
use App\Article;
use App\Http\Resources\TagResource;
use App\Http\Resources\ArticleResource;

class Tags extends Controller
{
    public function list(Account $account)
    {
        $tags = Tag::select("tags.*")->leftJoin("article_tag", "tag_id", "tags.id")
            ->leftJoin("articles", "articles.id", "article_id")
            ->where("articles.account_id", $account->id)
            ->groupBy("tags.id")
            ->get();

        return TagResource::collection($tags);
    }

    public function articles(Account $account, Tag $tag)
    {
        $articles = $tag->articles->where("account_id", $account->id);

        return ArticleResource::collection($articles);
    }
}
