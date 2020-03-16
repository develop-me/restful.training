<?php

namespace App\Http\Controllers;

use Auth;

use App\AnimalFact;

use App\Http\Requests\AnimalFactRequest;
use App\Http\Resources\AnimalFactResource;

class AnimalFacts extends Controller
{
    public function random()
    {
        $facts = AnimalFact::all();
        return $facts->isEmpty() ? response(null, 204) : new AnimalFactResource($facts->random());
    }

    public function create(AnimalFactRequest $request) : AnimalFactResource
    {
        $data = $request->only(["fact", "made_up"]);
        $data["user_id"] = Auth::id();
        $fact = AnimalFact::create($data);

        return new AnimalFactResource($fact);
    }
}
