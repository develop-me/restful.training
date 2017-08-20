<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Tag;
use App\Article;

class Tags extends Controller
{
    public function articles(Account $account, Tag $tag)
    {
        return $tag->articles->where("account_id", $account->id)->all();
    }
}
