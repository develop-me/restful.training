<?php

use Illuminate\Http\Request;

$hostname = config("app.hostname");

$router->post("accounts", "Accounts@create");

$router->group([
    "domain" => "{account}.{$hostname}",
    "middleware" => ["key"],
], function ($router) {
    $router->group(["prefix" => "blog"], function ($router) {
        $router->group(["prefix" => "articles"], function ($router) {
            $router->get("", "Articles@list");
            $router->post("", "Articles@create");

            $router->group(["middleware" => "account"], function ($router) {
                $router->get("{article}", "Articles@read");
                $router->put("{article}", "Articles@update");
                $router->patch("{article}", "Articles@patch");
                $router->delete("{article}", "Articles@delete");
                $router->get("{article}/comments", "Comments@list");
                $router->post("{article}/comments", "Comments@create");
            });
        });

        $router->group(["prefix" => "tags"], function ($router) {
            $router->get("", "Tags@list");
            $router->get("{tag}/articles", "Tags@articles");
        });
    });

    $router->group(["prefix" => "counters"], function ($router) {
        $router->get("", "Counters@show");
        $router->post("", "Counters@count");
        $router->put("", "Counters@step");
        $router->delete("", "Counters@reset");
    });
});
