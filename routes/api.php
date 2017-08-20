<?php

use Illuminate\Http\Request;

$hostname = config("app.hostname");

$router->post("accounts", "Accounts@create");

$router->group([
    "domain" => "{account}.{$hostname}",
    "middleware" => ["key"],
], function ($router) {
    $router->group(["prefix" => "articles"], function ($router) {
        $router->get("", "Articles@list");
        $router->post("", "Articles@create");

        $router->group(["middleware" => "account"], function ($router) {
            $router->get("{article}", "Articles@read");
            $router->put("{article}", "Articles@update");
            $router->delete("{article}", "Articles@delete");
            $router->post("{article}/comments", "Comments@create");
        });
    });

    $router->group(["prefix" => "tags"], function ($router) {
        $router->get("{tag}/articles", "Tags@articles");
    });
});
