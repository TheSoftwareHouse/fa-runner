<?php

declare(strict_types = 1);

namespace Application\Handler;

use Application\Command\EnrollRunnerToRun;
use Domain\Repository\RunnerRepository;
use Domain\Repository\RunParticipationRepository;
use Domain\Repository\RunRepository;

final class EnrollRunnerToRunHandler
{
    private $runnerRepository;

    private $runRepository;

    private $runParticipationRepository;

    public function __construct(
        RunnerRepository $runnerRepository,
        RunRepository $runRepository,
        RunParticipationRepository $runParticipationRepository
    ) {
        $this->runnerRepository = $runnerRepository;
        $this->runRepository = $runRepository;
        $this->runParticipationRepository = $runParticipationRepository;
    }

    /**
     * @throws \Domain\Exception\RunAlreadyParticipated
     * @throws \Domain\Exception\RunAlreadyStarted
     * @throws \Domain\Exception\RunNotFound
     * @throws \Domain\Exception\RunnerNotFound
     */
    public function handle(EnrollRunnerToRun $command): void
    {
        $run = $this->runRepository->getById($command->getRunId());
        $runner = $this->runnerRepository->getById($command->getRunnerId());

        $runParticipation = $runner->participate($run);

        $this->runParticipationRepository->save($runParticipation);
    }
}
