<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Session;
use App\Models\User;
use App\Http\Requests\Auth\Session\CreateRequest;
use Carbon\Carbon;

class SessionController extends Controller
{
    public function create(CreateRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $player = Player::query()->where('user_id', $user->id)->first();
        $dataSession = $request->validated();

        /** @var Session $session */
        $session = Session::query()->create([
            'player_id' => $player->id,
            'map_name' => $dataSession['map_name'],
            'score' => $dataSession['score'],
            'session_duration' => $dataSession['session_duration'],
        ]);

        return responder()->success(['id' => $session->id])->respond();
    }
}
