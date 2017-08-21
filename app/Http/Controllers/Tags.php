<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Tag;
use App\Article;

class Tags extends Controller
{
    public function list(Account $account)
    {
        return Tag::select("tags.*")->leftJoin("article_tag", "tag_id", "tags.id")
            ->leftJoin("articles", "articles.id", "article_id")
            ->where("articles.account_id", $account->id)
            ->groupBy("tags.id")
            ->get();
    }

    public function articles(Account $account, Tag $tag)
    {
        return $tag->articles->where("account_id", $account->id)->all();
    }
}
