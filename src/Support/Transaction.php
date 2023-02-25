<?php

namespace Support;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HigherOrderTapProxy;
use Throwable;

final class Transaction
{
    /**
     * @param Closure $callback
     * @param Closure|null $finished
     * @param Closure|null $onError
     * @return HigherOrderTapProxy|mixed
     * @throws Throwable
     */
    public static function run(
        Closure $callback,
        Closure $finished = null,
        Closure $onError = null
    ): mixed
    {
        try {
            DB::beginTransaction();

            return tap($callback(), function ($result) use ($finished) {
                if (!is_null($finished)) {
                    $finished($result);
                }

                DB::commit();
            });
        } catch (Throwable $exception) {
            DB::rollBack();

            if (!is_null($onError)) {
                $onError($exception);
            }

            throw $exception;
        }
    }
}
