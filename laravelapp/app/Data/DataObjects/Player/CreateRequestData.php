<?php

namespace App\Data\DataObjects\Player;

use Spatie\LaravelData\Data;

class CreateRequestData extends Data
{
    public function __construct(
        public string $nickname,
    ) {
    }
}
