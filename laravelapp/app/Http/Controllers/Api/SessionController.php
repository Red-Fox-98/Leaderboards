<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use App\Http\Requests\Auth\Session\CreateRequest;
use App\Http\Requests\Api\Session\IndexRequest;
use App\Transformers\SessionTransformer;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function create(CreateRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $player = $user->player;

        if (!$player) {
            return responder()->error('401', 'Unauthorized')->respond(401);
        }

        $currentSession = $request->validated();

        $bestSession = Session::query()
            ->where('map_name', $currentSession['map_name'])
            ->where('player_id', $player->id)
            ->where('is_record', true)
            ->first();

        /** @var Session $session */
        $session = Session::query()->create([
            'player_id' => $player->id,
            'map_name' => $currentSession['map_name'],
            'score' => $currentSession['score'],
            'session_duration' => $currentSession['session_duration'],
            'is_record' => true,
        ]);

        if ($bestSession){
            if ($bestSession->score >= $session->score){
                $session->update(['is_record' => false]);
            }
            else{
                $bestSession->update(['is_record' => false]);
            }
        }

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

    public function listRecords(IndexRequest $request)
    {
        $sessions = Session::query()
            ->filter($request->validated())
            ->where('is_record' , true)
            ->orderByDesc('score')
            ->paginate();

        return responder()->success($sessions, new SessionTransformer())->respond();
    }
}
