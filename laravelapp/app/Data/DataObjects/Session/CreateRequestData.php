<?php

namespace App\Data\DataObjects\Session;

use Spatie\LaravelData\Data;

class CreateRequestData extends Data
{
    public function __construct(
        public string $map_name,
        public int $score,
        public int $session_duration,
        public array $data,
    ) {
    }
}
