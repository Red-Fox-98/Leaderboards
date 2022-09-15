<?php

namespace App\Http\Requests\Profile\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'last_name' => 'required|string|min:3',
            'name' => 'required|string|min:2',
            'middle_name' => 'nullable',
        ];
    }
}
