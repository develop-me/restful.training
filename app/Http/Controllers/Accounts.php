<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\User;

class Accounts extends Controller
{
    public function create(AccountRequest $request)
    {
        $data = $request->only(["name"]);
        $user = User::create($data);
        $token = $user->createToken("api-token");

        return [
            "name" => $user->name,
            "api_token" => $token->plainTextToken,
        ];
    }
}
