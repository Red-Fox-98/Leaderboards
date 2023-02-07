<?php

namespace App\Service\Session;


use App\Data\DataObjects\Session\CreateRequestData;
use App\Data\DataObjects\Session\IndexRequestData;
use App\Models\Session;
use App\Models\User;

final class SessionService
{
    public function __construct(private SessionDataService $sessionDataService)
    {
    }

    final public function create(CreateRequestData $data)
    {
        $is_record = true;
        /** @var User $user */
        $user = auth()->user();
        $player = $user->player;

        if (!$player) {
            return responder()->error('401', 'Unauthorized')->respond(401);
        }

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

        $this->sessionDataService->create($session->id, $data->data);

        return $session->id;
    }

    final public function index(IndexRequestData $data)
    {
        $sessions = Session::query()
            ->filter($data->toArray())
            ->orderByDesc('score')
            ->paginate();
        return $sessions;
    }
}
