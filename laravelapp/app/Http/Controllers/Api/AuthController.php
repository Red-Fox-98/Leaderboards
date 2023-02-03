<?php

namespace App\Http\Controllers\Api;

use App\Data\DataObjects\Auth\LoginRequestData;
use App\Data\DataObjects\Auth\RegisterRequestData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequestData $data){
        /** @var User $user */
        $user = User::query()->create([
            'email' => $data->email,
            'password' => bcrypt($data->password),
        ]);

        $token = $user->createToken('Authorisation token')->plainTextToken;

        return responder()->success(['token' => $token])->respond();
    }

    public function login(LoginRequestData $data){
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

        $token = $user->createToken('Authorisation token')->plainTextToken;

        return responder()->success(['token' => $token])->respond();
    }
}
