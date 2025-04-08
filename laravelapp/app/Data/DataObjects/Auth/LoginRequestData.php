<?php

namespace App\Data\DataObjects\Auth;

use Spatie\LaravelData\Data;

class LoginRequestData extends Data
{
    public function __construct(
        public string $nickname,
        public string $email,
        public string $password,
    ) {
    }
}
