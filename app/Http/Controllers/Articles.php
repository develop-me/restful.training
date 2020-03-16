<?php

namespace App\Http\Controllers;

use Auth;

use App\Article;
use App\Tag;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticlePatchRequest;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleListResource;

class Articles extends Controller
{
    public function create(ArticleRequest $request)
    {
        // get post request data for title and article
        $data = $request->only(["title", "content"]);
        $data["user_id"] = Auth::id();
        $article = Article::create($data);

        $tags = Tag::parse($request->get("tags", []));
        $article->setTags($tags);

        return new ArticleResource($article);
    }

    public function list()
    {
        $articles = auth()->user()->articles;
        return ArticleListResource::collection($articles);
    }

    public function read(Article $article)
    {
        return new ArticleResource($article);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $data = $request->only(["title", "content"]);
        $article->fill($data)->save();

        $tags = Tag::parse($request->get("tags", []));
        $article->setTags($tags);

        return new ArticleResource($article);
    }

    public function patch(ArticlePatchRequest $request, Article $article)
    {
        $data = $request->all();
        $article->fill($data)->save();

        $tagsRequest = $request->get("tags");

        if ($tagsRequest) {
            $tags = Tag::parse($request->get("tags", []));
            $article->setTags($tags);
        }

        return new ArticleResource($article);
    }

    public function delete(Article $article)
    {
        $article->delete();
        return response(null, 204);
    }
}
