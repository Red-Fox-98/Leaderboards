<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\SessionData;
use App\Models\User;
use App\Http\Requests\Auth\Session\CreateRequest;
use App\Http\Requests\Api\Session\IndexRequest;
use App\Transformers\SessionTransformer;

class SessionController extends Controller
{
    public function create(CreateRequest $request)
    {
        $is_record = true;
        /** @var User $user */
        $user = auth()->user();
        $player = $user->player;

        if (!$player) {
            return responder()->error('401', 'Unauthorized')->respond(401);
        }

        $currentSession = $request->validated();
        $sessionData = json_encode($currentSession['data']);
        $bestSession = Session::query()->filter(['player_id' => $player->id, 'map_name' => $currentSession['map_name'], 'is_record' => true])->first();

        if ($bestSession) {
            if ($bestSession->score >= $currentSession['score']) {
                $is_record = false;
            } else {
                $bestSession->update(['is_record' => false]);
            }
        }

        /** @var Session $session */
        $session = Session::query()->create([
            'player_id' => $player->id,
            'map_name' => $currentSession['map_name'],
            'score' => $currentSession['score'],
            'session_duration' => $currentSession['session_duration'],
            'is_record' => $is_record,
        ]);

        SessionData::query()->create([
            'session_id' => $session->id,
            'data' => $sessionData,
        ]);

        return responder()->success(['id' => $session->id])->respond();
    }

    public function index(IndexRequest $request)
    {
        $sessions = Session::query()
            ->filter($request->validated())
            ->orderByDesc('score')
            ->paginate();
        return responder()->success($sessions, new SessionTransformer())->respond();
    }
}
