<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use App\Account;

class Accounts extends Controller
{
    public function create(AccountRequest $request)
    {
        $data = $request->only(["name"]);
        $account = Account::create($data);

        return [
            "uri" => $account->uri(),
        ];
    }
}
