<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;

class RegisterNewUserActionFake implements RegisterNewUserContract
{

    public function __invoke(NewUserDTO $data): void
    {
    }
}
