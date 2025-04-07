<?php

namespace App\Http\Requests\Api\Session;

use App\Data\DataObjects\Session\IndexRequestData;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'map_name' => [ 'nullable', 'string' ],
            'is_record' => [ 'boolean' ],
        ];
    }

    public function getData(): IndexRequestData
    {
        return IndexRequestData::from($this->validated());
    }
}
