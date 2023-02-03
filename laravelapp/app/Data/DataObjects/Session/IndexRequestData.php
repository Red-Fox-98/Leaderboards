<?php

namespace App\Data\DataObjects\Session;

use Spatie\LaravelData\Data;

class IndexRequestData extends Data
{
    public function __construct(
        public string $map_name,
        public bool $is_record,
    ) {
    }
}
