<?php

namespace App\Service\Player;

use App\Data\DataObjects\Player\CreateRequestData;
use App\Models\Player;
use App\Models\User;

final class PlayerService
{
    public function __construct()
    {

    }

    final public function create(CreateRequestData $data)
    {
        /** @var User $user */
        $user = auth()->user();

        /** @var Player $player */
        $player = Player::query()->create([
            'user_id' => $user->id,
            'nickname' => $data->nickname,
        ]);

        return $player->id;
    }
}
