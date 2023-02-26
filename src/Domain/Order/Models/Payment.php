<?php

declare(strict_types=1);

namespace Domain\Order\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Domain\Order\States\Payment\PaymentState;
use Spatie\ModelStates\HasStates;

final class Payment extends Model
{
    use HasFactory;
    use HasStates;
    use HasUuids;

    protected $fillable = [
        'payment_gateway',
        'payment_id',
        'meta'
    ];

    protected $casts = [
        'meta' => 'collection',
        'state' => PaymentState::class,
    ];

    public function uniqueIds(): array
    {
        return ['payment_id'];
    }
}
