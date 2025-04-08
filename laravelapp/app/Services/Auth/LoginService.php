<?php

namespace App\Services\Auth;

use App\Data\DataObjects\Auth\LoginRequestData;
use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class LoginService
{
    public function __construct()
    {

    }

    final public function login(LoginRequestData $data)
    {
        $user = $this->getUser($data->email);

        if (!$user) {
            DB::transaction(function () use ($data) {
                /** @var User $user */
                $user = User::query()->create([
                    'email' => $data->email,
                    'password' => bcrypt($data->password),
                ]);

                Player::query()->create([
                    'user_id' => $user->id,
                    'nickname' => $data->nickname,
                ]);
            });
        } else {
            if (!Hash::check($data->password, $user->password)){
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            foreach ($user->tokens as $token) {
                if($token->tokenable_id == $user->id){
                    $token->forceDelete();
                }
            }

            Player::query()->where('user_id', $user->id)->update([
                'nickname' => $data->nickname
            ]);
        }

        $user = $this->getUser($data->email);

        return $user->createToken('Authorisation token')->plainTextToken;
    }

    private function getUser(string $email): ?User
    {
        /** @var User $user */
        $user = User::query()->where('email', $email)->first();

        return $user;
    }
}
