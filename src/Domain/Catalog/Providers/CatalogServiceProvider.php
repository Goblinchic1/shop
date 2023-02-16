<?php

namespace Domain\Catalog\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{

    public function boot(): void
    {

    }


    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );
    }
}
