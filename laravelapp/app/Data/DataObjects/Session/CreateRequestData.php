<?php

namespace App\Data\DataObjects\Session;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class CreateRequestData extends Data
{
    public function __construct(
        #[MapInputName('map_name')]
        public string $mapName,
        public int $score,
        #[MapInputName('$session_duration')]
        public int $sessionDuration,
        public array $data,
    ) {
    }
}
