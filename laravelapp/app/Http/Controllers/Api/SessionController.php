<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use App\Http\Requests\Auth\Session\CreateRequest;
use App\Http\Requests\Api\Session\IndexRequest;
use App\Transformers\SessionTransformer;
use function GuzzleHttp\Promise\all;

class SessionController extends Controller
{
    public function create(CreateRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $player = $user->player;
        $dataSession = $request->validated();

        if (!$player) {
            return responder()->error('401', 'Unauthorized')->respond(401);
        }

        /** @var Session $session */
        $session = Session::query()->create([
            'player_id' => $player->id,
            'map_name' => $dataSession['map_name'],
            'score' => $dataSession['score'],
            'session_duration' => $dataSession['session_duration'],
        ]);

        return responder()->success(['id' => $session->id])->respond();
    }

    public function indexAll(IndexRequest $request)
    {
        $sessions = Session::query()->filter($request->validated())->orderByDesc('score')->paginate();
        return responder()->success($sessions, new SessionTransformer())->respond();
    }

    public function index(IndexRequest $request)
    {
        $sessions = Session::query()
            ->orderBy('score', 'DESC')
            ->filter($request->validated())
            ->get()
            ->unique('player_id')
            ->take(25);
        return responder()->success($sessions, new SessionTransformer())->respond();
    }
}
