<?php

namespace Domain\Catalog\Observers;
use Domain\Catalog\Models\Brand;
use Illuminate\Support\Facades\Cache;

class BrandObserver
{
    public function created(Brand $brand): void
    {
        Cache::forget('brand home page');
    }


    public function updated(Brand $brand): void
    {
        Cache::forget('brand home page');
    }


    public function deleted(Brand $brand): void
    {
        Cache::forget('brand home page');
    }
}
