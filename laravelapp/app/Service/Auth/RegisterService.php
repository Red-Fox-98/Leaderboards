<?php

namespace App\Service\Auth;

use App\Data\DataObjects\Auth\RegisterRequestData;
use App\Models\User;

final class RegisterService
{
    public function __construct()
    {

    }

    final public function register(RegisterRequestData $data)
    {
        /** @var User $user */
        $user = User::query()->create([
            'email' => $data->email,
            'password' => bcrypt($data->password),
        ]);

        return $user->createToken('Authorisation token')->plainTextToken;
    }
}
