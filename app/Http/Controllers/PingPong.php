<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Game;

use App\Http\Requests\PingPongRequest;
use App\Http\Requests\PingPongScoreRequest;

use App\Http\Resources\PingPongResource;

class PingPong extends Controller
{
    public function list() : ResourceCollection
    {
        $games = Auth::user()->games->sortByDesc("updated_at");
        return PingPongResource::collection($games);
    }

    public function create(PingPongRequest $request) : PingPongResource
    {
        $data = $request->all();
        $data["user_id"] = Auth::id();
        $game = Game::create($data);
        return new PingPongResource($game);
    }

    public function show(Game $game) : PingPongResource
    {
        return new PingPongResource($game);
    }

    public function score(PingPongScoreRequest $request, Game $game) : PingPongResource
    {
        if (!$game->complete()) {
            $game->score($request->get("player"));
        }

        return new PingPongResource($game);
    }

    public function reset(Game $game) : Response
    {
        $game->delete();
        return response(null, 204);
    }
}
