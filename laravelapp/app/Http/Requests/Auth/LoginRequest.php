<?php

namespace App\Http\Requests\Auth;

use App\Data\DataObjects\Auth\LoginRequestData;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'email' => [ 'required', 'email' ],
            'password' => [ 'required' ]
        ];

        try {
            $email = $this->input('email');
            /** @var User $user */
            $user = User::query()->where('email', $email)->firstOrFail();
            $rules['nickname'] = [ 'required', 'string' , 'unique:players,nickname,'. $user->player->id];
        } catch (ModelNotFoundException $e) {
            $rules['nickname'] = [ 'required', 'string' , 'unique:players,nickname'];
        }

        return $rules;
    }

    public function getData(): LoginRequestData
    {
        return LoginRequestData::from($this->validated());
    }
}
