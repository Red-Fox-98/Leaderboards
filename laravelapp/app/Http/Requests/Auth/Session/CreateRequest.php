<?php

namespace App\Http\Requests\Auth\Session;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'map_name' => 'required|string',
            'score' => 'required|int',
            'session_duration' => 'required|int|min:0',
        ];
    }
}
