<?php

namespace Chrisdicarlo\LaravelProductionSeeder;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chrisdicarlo\LaravelProductionSeeder\Skeleton\SkeletonClass
 */
class LaravelProductionSeederFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-production-seeder';
    }
}
