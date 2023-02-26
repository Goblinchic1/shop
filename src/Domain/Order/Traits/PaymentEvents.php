<?php

namespace Domain\Order\Traits;

use Closure;

trait PaymentEvents
{
    protected static Closure $onCreating;

    protected static Closure $onSuccess;

    protected static Closure $onValidating;

    protected static Closure $onError;

    protected static function onCreating(Closure $event): void
    {
        self::$onCreating = $event;
    }

    protected static function onSuccess(Closure $event): void
    {
        self::$onSuccess = $event;
    }

    protected static function onValidating(Closure $event): void
    {
        self::$onValidating = $event;
    }

    protected static function onError(Closure $event): void
    {
        self::$onError = $event;
    }
}
