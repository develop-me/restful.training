<?php

namespace App\Http\Controllers;

use App\Account;
use App\Article;
use App\Comment;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;

class Articles extends Controller
{
    public function create(ArticleRequest $request, Account $account)
    {
        // get post request data for title and article
        $data = $request->only(["title", "article"]);
        $data["account_id"] = $account->id;
        $article = Article::create($data);

        $tags = Tag::parse($request->get("tags", []));
        $article->setTags($tags);

        return $article;
    }

    public function list(Account $account)
    {
        return Article::where("account_id", $account->id)->get()->map(function ($article) {
            return [
                "id" => $article->id,
                "title" => $article->title,
                "tags" => $article->tags,
            ];
        });
    }

    public function read(Account $account, Article $article)
    {
        return $article;
    }

    public function update(ArticleRequest $request, Account $account, Article $article)
    {
        $data = $request->only(["title", "article"]);
        $article->fill($data)->save();

        $tags = Tag::parse($request->get("tags", []));
        $article->setTags($tags);

        return $article;
    }

    public function delete(Account $account, Article $article)
    {
        $article->delete();
        return response(null, 200);
    }
}
