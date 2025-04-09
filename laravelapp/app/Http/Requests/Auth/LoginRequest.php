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
        try {
            $email = $this->input('email');
            /** @var User $user */
            $user = User::query()->where('email', $email)->firstOrFail();
            $playerId = $user->player->id;
        } catch (ModelNotFoundException $e) {
            $playerId = null;
        }

        return [
            'nickname' => [ 'required', 'string' , 'unique:players,nickname,'.$playerId],
            'email' => [ 'required', 'email' ],
            'password' => [ 'required' ],
        ];
    }

    public function getData(): LoginRequestData
    {
        return LoginRequestData::from($this->validated());
    }
}
