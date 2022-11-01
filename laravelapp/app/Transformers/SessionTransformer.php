<?php

namespace App\Transformers;

use App\Models\Session;
use Flugg\Responder\Transformers\Transformer;

class SessionTransformer extends Transformer
{
    public function transform(Session $session): mixed
    {
        return [
            'nickname' => $session->player->nickname,
            'map_name' => $session->map_name,
            'score' => $session->score,
        ];
    }
}
