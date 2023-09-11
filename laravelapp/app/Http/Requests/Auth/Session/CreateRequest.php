<?php

namespace App\Http\Requests\Auth\Session;

use App\Data\DataObjects\Session\CreateRequestData;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'map_name' => 'required|string',
            'score' => 'required|int|min:0',
            'session_duration' => 'required|int|min:0',
            'data'   => 'array|min:1|nullable',
        ];
    }

    public function getData(): CreateRequestData
    {
        return CreateRequestData::from($this->validated());
    }
}
