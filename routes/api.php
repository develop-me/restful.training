<?php

$router->post("accounts", "Accounts@create");

$router->group(["middleware" => ["auth:airlock"]], function ($router) {
    $router->group(["prefix" => "blog"], function ($router) {
        $router->group(["prefix" => "articles"], function ($router) {
            $router->get("", "Articles@list");
            $router->post("", "Articles@create");

            $router->group(["middleware" => "owns:article"], function ($router) {
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

    $router->group(["prefix" => "ping-pong/games"], function ($router) {
        $router->get("", "PingPong@list");
        $router->post("", "PingPong@create");

        $router->group(["middleware" => "owns:game"], function ($router) {
            $router->get("{game}", "PingPong@show");
            $router->delete("{game}", "PingPong@reset");
            $router->patch("{game}/score", "PingPong@score");
        });
    });

    $router->group(["prefix" => "animal-facts"], function ($router) {
        $router->post("", "AnimalFacts@create");
        $router->get("random", "AnimalFacts@random");
    });

    $router->group(["prefix" => "tasks"], function ($router) {
        $router->get("", "Tasks@list");
        $router->post("", "Tasks@create");

        $router->group(["middleware" => "owns:task"], function ($router) {
            $router->get("{task}", "Tasks@read");
            $router->patch("{task}", "Tasks@update");
            $router->patch("{task}/complete", "Tasks@complete");
            $router->delete("{task}", "Tasks@delete");
        });
    });
});
