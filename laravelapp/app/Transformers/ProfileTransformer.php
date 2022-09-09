<?php

namespace App\Transformers;

use App\Models\Profile;
use Flugg\Responder\Transformers\Transformer;

class ProfileTransformer extends Transformer
{
    public function transform(Profile $profile): array
    {
        return [
            'user_id' => $profile->user_id,
            'last_name' => $profile->last_name,
            'name' => $profile->name,
            'middle_name' => $profile->middle_name,
        ];
    }
}
