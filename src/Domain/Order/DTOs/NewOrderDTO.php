<?php

namespace Domain\Order\DTOs;

use App\Http\Requests\OrderFormRequest;
use Support\Traits\Makeable;

class NewOrderDTO
{
    use Makeable;

    public function __construct(
        public readonly array $customer,
        public readonly int $delivery_type_id,
        public readonly int $payment_method_id,
        public readonly bool $create_account,
        public readonly string|null $password,
        public readonly string|null $password_confirmation
    )
    {
    }


    public static function fromRequest(OrderFormRequest $request): NewOrderDTO
    {
        return self::make(
            $request->customer,
            $request->delivery_type_id,
            $request->payment_method_id,
            $request->boolean('create_account'),
            $request->password,
            $request->password_confirmation
        );
    }
}
