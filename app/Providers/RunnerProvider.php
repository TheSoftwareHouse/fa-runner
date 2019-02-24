<?php

namespace App\Providers;

use Domain\Repository\RunnerRepository;
use Domain\Repository\RunParticipationRepository;
use Domain\Repository\RunRepository;
use Domain\Repository\RunResultRepository;
use Illuminate\Support\ServiceProvider;

class RunnerProvider extends ServiceProvider
{
    public $bindings = [
        RunnerRepository::class => \Infrastructure\Eloquent\Repository\RunnerRepository::class,
        RunRepository::class => \Infrastructure\Eloquent\Repository\RunRepository::class,
        RunParticipationRepository::class => \Infrastructure\Eloquent\Repository\RunParticipationRepository::class,
        RunResultRepository::class => \Infrastructure\Eloquent\Repository\RunResultRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
