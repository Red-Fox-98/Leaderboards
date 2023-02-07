<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Session\IndexRequest;
use App\Http\Requests\Auth\Session\CreateRequest;
use App\Service\Session\SessionService;
use App\Transformers\SessionTransformer;

class SessionController extends Controller
{
    public function __construct(private SessionService $sessionService)
    {
    }
    public function create(CreateRequest $request)
    {
        $id = $this->sessionService->create($request->getData());
        return responder()->success(['id' => $id])->respond();
    }

    public function index(IndexRequest $request)
    {
        $sessions = $this->sessionService->index($request->getData());
        return responder()->success($sessions, new SessionTransformer())->respond();
    }
}
