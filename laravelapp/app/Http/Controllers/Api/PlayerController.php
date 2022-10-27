<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\User;
use App\Http\Requests\Auth\Player\CreateRequest;

class PlayerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $data = $request->validated();

        /** @var Player $player */
        $player = Player::query()->create([
            'user_id' => $user->id,
            'nickname' => $data['nickname'],
        ]);

        return responder()->success(['id' => $player->id])->respond();
    }
}
