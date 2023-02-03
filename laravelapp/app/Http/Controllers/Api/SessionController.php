<?php

namespace App\Http\Controllers\Api;

use App\Data\DataObjects\Session\CreateRequestData;
use App\Data\DataObjects\Session\IndexRequestData;
use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use App\Transformers\SessionTransformer;

class SessionController extends Controller
{
    public function create(CreateRequestData $data)
    {
        $is_record = true;
        /** @var User $user */
        $user = auth()->user();
        $player = $user->player;

        if (!$player) {
            return responder()->error('401', 'Unauthorized')->respond(401);
        }

        $sessionData = json_encode($data->data);
        $bestSession = Session::query()->filter(['player_id' => $player->id, 'map_name' => $data->mapName, 'is_record' => true])->first();

        if ($bestSession) {
            if ($bestSession->score >= $data->score) {
                $is_record = false;
            } else {
                $bestSession->update(['is_record' => false]);
            }
        }

        /** @var Session $session */
        $session = Session::query()->create([
            'player_id' => $player->id,
            'map_name' => $data->mapName,
            'score' => $data->score,
            'session_duration' => $data->sessionDuration,
            'is_record' => $is_record,
        ]);

        $session->sessionData()->create([
            'session_id' => $session->id,
            'data' => $sessionData,
        ]);

        return responder()->success(['id' => $session->id])->respond();
    }

    public function index(IndexRequestData $data)
    {
        $sessions = Session::query()
            ->filter($data->toArray())
            ->orderByDesc('score')
            ->paginate();
        return responder()->success($sessions, new SessionTransformer())->respond();
    }
}
