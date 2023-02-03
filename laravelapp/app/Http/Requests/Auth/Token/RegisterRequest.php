<?php

namespace App\Http\Requests\Auth\Token;

use App\Data\DataObjects\Auth\RegisterRequestData;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

        public function getData(): RegisterRequestData
    {
        return RegisterRequestData::from($this->validated());
    }
}
