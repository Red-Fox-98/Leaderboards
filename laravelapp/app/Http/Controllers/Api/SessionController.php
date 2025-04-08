<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Session\CreateRequest;
use App\Http\Requests\Api\Session\IndexRequest;
use App\Services\Session\SessionService;
use App\Transformers\SessionTransformer;
use Illuminate\Http\JsonResponse;

class SessionController extends Controller
{
    public function __construct(private SessionService $sessionService)
    {
    }
    public function store(CreateRequest $request): JsonResponse
    {
        $session = $this->sessionService->create($request->getData());

        return responder()->success(['id' => $session->id])->respond();
    }

    public function index(IndexRequest $request): JsonResponse
    {
        $sessions = $this->sessionService->index($request->getData());

        return responder()->success($sessions, new SessionTransformer())->respond();
    }
}
