<?php

namespace App\Http\Requests\Auth\Player;

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
            'nickname' => 'required|unique:players,nickname|string|max:255',
        ];
    }
}
