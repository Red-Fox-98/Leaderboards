<?php

namespace App\Data\DataObjects\Session;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class IndexRequestData extends Data
{
    public function __construct(
        public ?string $mapName,
        public ?bool $isRecord,
    ) {
    }
}
