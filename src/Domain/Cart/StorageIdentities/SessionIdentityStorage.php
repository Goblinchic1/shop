<?php

namespace Domain\Cart\StorageIdentities;

use Domain\Cart\Contracts\CartIdentityStorageContract;

final class SessionIdentityStorage implements CartIdentityStorageContract
{
    public function get(): string
    {
        return session()->getId();
    }
}
