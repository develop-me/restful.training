<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\User;
use App\Http\Requests\AccountRequest;

class Accounts extends Controller
{
    public function create(AccountRequest $request) : JsonResponse
    {
        $data = $request->only(["name"]);
        $user = User::create($data);
        $token = $user->createToken("api-token");

        return response()->json([
            "name" => $user->name,
            "api_token" => $token->plainTextToken,
        ]);
    }
}
