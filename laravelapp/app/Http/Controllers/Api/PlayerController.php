<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Player\CreateRequest;
use App\Service\Player\PlayerService;

class PlayerController extends Controller
{
    public function __construct(private PlayerService $playerService)
    {
    }
    public function create(CreateRequest $request)
    {
        $player = $this->playerService->create($request->getData());
        return responder()->success(['id' => $player->id])->respond();
    }
}
