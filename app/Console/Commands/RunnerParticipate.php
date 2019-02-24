<?php

namespace App\Console\Commands;

use Application\Command\EnrollRunnerToRun;
use Application\Handler\EnrollRunnerToRunHandler;
use Common\Id;
use Domain\Exception\DomainException;
use Illuminate\Console\Command;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class RunnerParticipate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'runner:enroll {runnerId} {runId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enroll runner to run';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(CommandBusInterface $commandBus)
    {
        $commandBus->addHandler(EnrollRunnerToRun::class, EnrollRunnerToRunHandler::class);

        $runnerId = Id::create($this->argument('runnerId'));
        $runId = Id::create($this->argument('runId'));

        $command = new EnrollRunnerToRun($runnerId, $runId);

        try {
            $commandBus->dispatch($command);

            $this->info('Runner enrolled');
        } catch (DomainException $e) {
            $this->error($e->getMessage());
        }
    }
}
