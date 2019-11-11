<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use App\AnimalFact;
use App\Account;

use App\Http\Requests\AnimalFactRequest;
use App\Http\Resources\AnimalFactResource;

class AnimalFacts extends Controller
{
    public function random(Account $account)
    {
        $facts = AnimalFact::all();
        return $facts->isEmpty() ? response(null, 204) : new AnimalFactResource($facts->random());
    }

    public function create(AnimalFactRequest $request, Account $account) : AnimalFactResource
    {
        $data = $request->only(["fact", "made_up"]);
        $data["account_id"] = $account->id;
        $fact = AnimalFact::create($data);

        return new AnimalFactResource($fact);
    }
}
