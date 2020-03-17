<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\JsonResponse;

use App\AnimalFact;

use App\Http\Requests\AnimalFactRequest;
use App\Http\Resources\AnimalFactResource;

class AnimalFacts extends Controller
{
    public function random() : JsonResponse
    {
        $facts = AnimalFact::all();

        if ($facts->isEmpty()) {
            return new JsonResponse(null, 204);
        }

        return (new AnimalFactResource($facts->random()))->response();
    }

    public function create(AnimalFactRequest $request) : AnimalFactResource
    {
        $data = $request->only(["fact", "made_up"]);
        $data["user_id"] = Auth::id();
        $fact = AnimalFact::create($data);

        return new AnimalFactResource($fact);
    }
}
