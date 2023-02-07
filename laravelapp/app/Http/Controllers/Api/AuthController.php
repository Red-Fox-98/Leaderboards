<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Token\LoginRequest;
use App\Http\Requests\Auth\Token\RegisterRequest;
use App\Service\Auth\LoginService;
use App\Service\Auth\RegisterService;

class AuthController extends Controller
{
    /** @var LoginService */
    private $loginService;
    /** @var RegisterService */
    private $registerService;
    public function __construct()
    {
        $this->loginService = app(LoginService::class);
        $this->registerService = app(RegisterService::class);
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
