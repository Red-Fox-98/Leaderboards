<?php

namespace App\Data\DataObjects\Auth;

use Spatie\LaravelData\Data;

class RegisterRequestData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
