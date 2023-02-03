<?php

namespace App\Data\DataObjects\Session;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class IndexRequestData extends Data
{
    public function __construct(
        #[MapInputName('map_name')]
        public string $mapName,
        #[MapInputName('$is_record')]
        public bool $isRecord,
    ) {
    }
}
