<?php

namespace App\Http\Controllers;

use App\Account;
use App\Game;

use App\Http\Requests\PingPongRequest;
use App\Http\Requests\PingPongScoreRequest;

use App\Http\Resources\PingPongResource;

class PingPong extends Controller
{
    public function list(Account $account)
    {
        $games = Game::where("account_id", $account->id)->orderBy("updated_at", "desc")->get();
        return PingPongResource::collection($games);
    }

    public function create(PingPongRequest $request, Account $account)
    {
        $game = new Game();
        $game->player_1 = $request->get("player_1");
        $game->player_2 = $request->get("player_2");
        $game->winning_score = $request->get("winning_score", $game->winning_score);
        $game->change_serve = $request->get("change_serve", $game->change_serve);
        $game->account_id = $account->id;
        $game->save();

        return new PingPongResource($game);
    }

    public function show(Account $account, Game $game)
    {
        return new PingPongResource($game);
    }

    public function score(PingPongScoreRequest $request, Account $account, Game $game)
    {
        if (!$game->complete()) {
            $game->score($request->get("player"));
        }

        return new PingPongResource($game);
    }

    public function reset(Account $account, Game $game)
    {
        $game->delete();
        return response(null, 204);
    }
}
