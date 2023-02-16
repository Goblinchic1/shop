<?php

namespace Domain\Auth\Contracts;

use Domain\Auth\DTOs\NewUserDTO;

interface RegisterNewUserContract
{
    public function __invoke(NewUserDTO $data);
}
