<?php

namespace App\Services\Auth;

use App\Data\DataObjects\Auth\LoginRequestData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class LoginService
{
    public function __construct()
    {

    }

    final public function login(LoginRequestData $data)
    {
        /** @var User $user */
        $user = User::query()->where('email', $data->email)->first();

        /** @var $token */
        foreach ($user->tokens as $token) {
            if($token->tokenable_id == $user->id){
                $token->forceDelete();
            }
        }

        if (! $user || ! Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('Authorisation token')->plainTextToken;
    }
}
