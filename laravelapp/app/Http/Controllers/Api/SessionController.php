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
        $dataSession = $request->validated();
        $maxRecord = Session::query()->where('map_name', $dataSession['map_name'])->orderByDesc('score')->where('player_id', $player->id)->first();

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
        Session::query()->where('id', $session->id)->update(['is_record' => true]);

        if ($maxRecord){
            if ($session->score >= $maxRecord->score){
                Session::query()->where('id', $maxRecord->id)->update(['is_record' => false]);
            }
            else{
                Session::query()->where('id', $session->id)->update(['is_record' => false]);
                Session::query()->where('id', $maxRecord->id)->update(['is_record' => true]);
            }
        }

        return responder()->success(['id' => $session->id])->respond();
    }

    public function index(IndexRequest $request)
    {
        $sessions = Session::query()->filter($request->validated())->orderByDesc('score')->paginate();
        return responder()->success($sessions, new SessionTransformer())->respond();
    }

    public function listRecords(IndexRequest $request)
    {
        $sessions = Session::query()
            ->filter($request->validated())
            ->where('is_record' ,'1')
            ->orderByDesc('score')
            ->paginate();

        return responder()->success($sessions, new SessionTransformer())->respond();
    }
}
