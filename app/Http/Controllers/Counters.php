<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Response;

use App\Counter;

use App\Http\Requests\CounterRequest;
use App\Http\Requests\CounterStepRequest;
use App\Http\Resources\CounterResource;

class Counters extends Controller
{
    public function show() : CounterResource
    {
        $counter = Counter::forUser(Auth::user());
        return new CounterResource($counter);
    }

    public function count(CounterRequest $request) : CounterResource
    {
        $counter = Counter::forUser(Auth::user());
        $counter->count = $request->get("count");
        $counter->save();
        return new CounterResource($counter);
    }

    public function step(CounterStepRequest $request) : CounterResource
    {
        $counter = Counter::forUser(Auth::user());
        $counter->step = $request->get("step");
        $counter->save();
        return new CounterResource($counter);
    }

    public function reset() : Response
    {
        $counter = Counter::forUser(Auth::user());
        $counter->delete();
        return response(null, 204);
    }
}
