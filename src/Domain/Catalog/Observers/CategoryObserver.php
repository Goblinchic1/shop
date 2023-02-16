<?php

namespace Domain\Catalog\Observers;
use Domain\Catalog\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public function created(Category $category): void
    {
        Cache::forget('category home page');
    }


    public function updated(Category $category): void
    {
        Cache::forget('category home page');
    }


    public function deleted(Category $category): void
    {
        Cache::forget('category home page');
    }
}
