<?php

namespace App\Traits\Model;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $item) {
            $item->slug = $item->slug
                ?? str($item->{self::slugFrom()})
                    ->append(time())
                    ->slug();
        });
    }


    public static function slugFrom(): string
    {
        return 'title';
    }
}
