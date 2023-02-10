<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Token\LoginRequest;
use App\Http\Requests\Auth\Token\RegisterRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;

class AuthController extends Controller
{
    public function __construct(private LoginService $loginService, private RegisterService $registerService)
    {
    }

    public function register(RegisterRequest $request){
        $token = $this->registerService->register($request->getData());
        return responder()->success(['token' => $token])->respond();
    }

    public function login(LoginRequest $request){
        $token = $this->loginService->login($request->getData());
        return responder()->success(['token' => $token])->respond();
    }
}
