<?php

namespace App\Http\Requests\Api\Session;

use App\Models\Session;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'map_name' => 'nullable|string',
        ];
    }
}
