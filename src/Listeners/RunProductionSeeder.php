<?php

namespace ChrisDiCarlo\LaravelProductionSeeder\Listeners;

use ChrisDiCarlo\LaravelProductionSeeder\Contracts\RunsProductionSeeder;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class RunProductionSeeder
{
    public function handle(MigrationEnded $event)
    {
        $class = new ReflectionClass($event->migration);

        if (!$class->implementsInterface(RunsProductionSeeder::class)) {
            return;
        }

        $path = database_path('seeders/Production/' . basename($class->getFileName()));

        if (file_exists($path)) {
            $seeder = File::getRequire($path);
            $seeder = new $seeder;
            $seeder->run();
        }
    }
}
