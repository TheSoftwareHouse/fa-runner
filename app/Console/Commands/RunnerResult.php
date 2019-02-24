<?php

namespace App\Console\Commands;

use Application\Command\SaveRunnerResult;
use Application\Handler\SaveRunnerResultHandler;
use Common\Id;
use Domain\Exception\DomainException;
use Illuminate\Console\Command;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class RunnerResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'runner:result {runnerId} {runId} {time}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Save runner's result";

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
        $commandBus->addHandler(SaveRunnerResult::class, SaveRunnerResultHandler::class);

        $runnerId = Id::create($this->argument('runnerId'));
        $runId = Id::create($this->argument('runId'));

        $command = new SaveRunnerResult($runId, $runnerId, (int)$this->argument('time'));

        try {
            $commandBus->dispatch($command);

            $this->info('Runner result saved');
        } catch (DomainException $e) {
            $this->error($e->getMessage());
        }
    }
}
