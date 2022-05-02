<?php

namespace ChrisDiCarlo\LaravelProductionSeeder\Listeners;

use ChrisDiCarlo\LaravelProductionSeeder\Contracts\RunsRefactor;
use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use Symfony\Component\Console\Output\ConsoleOutput;

class RunRefactor
{
    public function handle(MigrationEnded $event)
    {
        if (!app()->isProduction()) {
            return;
        }

        $class = new ReflectionClass($event->migration);

        if (!$class->implementsInterface(RunsRefactor::class)) {
            return;
        }

        $filename = basename($class->getFileName());
        $path = database_path('refactors/' . $filename);
        $refactorName = str_replace('.php', '', $filename);

        if (file_exists($path)) {
            if (app()->runningInConsole()) {
                $time = microtime(true);
                $console = new ConsoleOutput();
            }

            $console->writeln('<comment>Refactoring: </comment>' . $refactorName);
            $refactor = File::getRequire($path);
            $refactor = new $refactor;
            $refactor->run();

            if (app()->runningInConsole()) {
                $time = microtime(true) - $time;
                $console->writeln('<info>Refactored: </info>' . $refactorName . ' (' . number_format($time * 1000, 2) . 'ms)');
            }
        }
    }
}
