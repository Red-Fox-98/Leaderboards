<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Token\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use TheSeer\Tokenizer\Token;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        $data = $request->validated();

        /** @var User $user */
        $user = User::query()->where('email', $data['email'])->first();

        /** @var $token */
        foreach ($user->tokens as $token) {
            if($token->tokenable_id == $user->id){
                $token->forceDelete();
            }
        }

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('Authorisation token')->plainTextToken;

        return responder()->success(['token' => $token])->respond();
    }
}
