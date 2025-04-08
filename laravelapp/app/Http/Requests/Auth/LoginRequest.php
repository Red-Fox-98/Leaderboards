<?php

namespace App\Http\Requests\Auth;

use App\Data\DataObjects\Auth\LoginRequestData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nickname' => [ 'required', 'string' ],
            'email' => [ 'required', 'email' ],
            'password' => [ 'required' ],
        ];
    }

    public function getData(): LoginRequestData
    {
        return LoginRequestData::from($this->validated());
    }
}
