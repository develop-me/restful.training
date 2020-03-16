<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $password = config("app.password");

        return [
            "name" => ["required", "string", "unique:users,name", "max:50"],
            "key" => ["required", "in:{$password}"],
        ];
    }
}
