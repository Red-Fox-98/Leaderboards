<?php

namespace App\Http\Requests\Auth\Player;

use App\Data\DataObjects\Player\CreateRequestData;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nickname' => ['required', 'unique:players', 'nickname', 'string', 'max:255' ],
        ];
    }

    public function getData(): CreateRequestData
    {
        return CreateRequestData::from($this->validated());
    }
}
