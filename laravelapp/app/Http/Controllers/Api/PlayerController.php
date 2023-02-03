<?php

namespace App\Http\Controllers\Api;

use App\Data\DataObjects\Player\CreateRequestData;
use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\User;

class PlayerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequestData $data)
    {
        /** @var User $user */
        $user = auth()->user();

        /** @var Player $player */
        $player = Player::query()->create([
            'user_id' => $user->id,
            'nickname' => $data->nickname,
        ]);

        return responder()->success(['id' => $player->id])->respond();
    }
}
