<?php

namespace ChrisDiCarlo\LaravelProductionSeeder;

use ChrisDiCarlo\LaravelProductionSeeder\Listeners\RunRefactor;
use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MigrationEnded::class => [
            RunRefactor::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
