<?php

namespace App\Http\Controllers\Api;

use App\Data\DataObjects\Auth\LoginRequestData;
use App\Data\DataObjects\Auth\RegisterRequestData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Token\LoginRequest;
use App\Models\User;
use App\Service\Auth\LoginService;

class AuthController extends Controller
{
    public function __construct(private LoginService $loginService)
    {
    }

    public function register(RegisterRequestData $data){
        /** @var User $user */
        $user = User::query()->create([
            'email' => $data->email,
            'password' => bcrypt($data->password),
        ]);

        $token = $user->createToken('Authorisation token')->plainTextToken;

        return responder()->success(['token' => $token])->respond();
    }

    public function login(LoginRequest $request){
        $token = $this->loginService->login($request->getData());

        return responder()->success(['token' => $token])->respond();
    }
}
