<?php

declare(strict_types = 1);

namespace Application\Handler;

use Application\Command\SaveRunnerResult;
use Domain\Repository\RunnerRepository;
use Domain\Repository\RunRepository;
use Domain\Repository\RunResultRepository;

final class SaveRunnerResultHandler
{
    private $runRepository;

    private $runnerRepository;

    private $runResultRepository;

    public function __construct(
        RunRepository $runRepository,
        RunnerRepository $runnerRepository,
        RunResultRepository $runResultRepository
    ) {
        $this->runRepository = $runRepository;
        $this->runnerRepository = $runnerRepository;
        $this->runResultRepository = $runResultRepository;
    }

    /**
     * @throws \Domain\Exception\RunNotFound
     * @throws \Domain\Exception\RunNotParticipated
     * @throws \Domain\Exception\RunResultAlreadySaved
     * @throws \Domain\Exception\RunResultExpired
     * @throws \Domain\Exception\RunnerNotFound
     * @throws \Domain\Exception\TimeLimitReached
     */
    public function handle(SaveRunnerResult $command): void
    {
        $run = $this->runRepository->getById($command->getRunId());
        $runner = $this->runnerRepository->getById($command->getRunnerId());

        $runResult = $runner->result($run, $command->getTime());

        $this->runResultRepository->save($runResult);
    }
}
