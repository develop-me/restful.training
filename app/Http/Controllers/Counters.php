<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use App\Counter;
use App\Account;

use App\Http\Requests\CounterRequest;
use App\Http\Requests\CounterStepRequest;
use App\Http\Resources\CounterResource;

class Counters extends Controller
{
    public function show(Account $account) : CounterResource
    {
        $counter = Counter::forAccount($account->id);
        return new CounterResource($counter);
    }

    public function count(CounterRequest $request, Account $account) : CounterResource
    {
        $counter = Counter::forAccount($account->id);
        $counter->count = $request->get("count");
        $counter->save();
        return new CounterResource($counter);
    }

    public function step(CounterStepRequest $request, Account $account) : CounterResource
    {
        $counter = Counter::forAccount($account->id);
        $counter->step = $request->get("step");
        $counter->save();
        return new CounterResource($counter);
    }

    public function reset(Account $account) : Response
    {
        $counter = Counter::forAccount($account->id);
        $counter->delete();
        return response(null, 204);
    }
}
