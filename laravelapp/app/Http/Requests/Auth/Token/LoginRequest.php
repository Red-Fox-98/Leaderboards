<?php

namespace App\Http\Requests\Auth\Token;

use App\Data\DataObjects\Auth\LoginData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function getData(): LoginData
    {
        return LoginData::from($this->validated());
    }
}
