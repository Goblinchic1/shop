<?php

namespace Domain\Auth\Contracts;

use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Models\User;

interface RegisterNewUserContract
{
    public function __invoke(NewUserDTO $data): User;
}
