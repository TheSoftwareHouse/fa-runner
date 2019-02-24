<?php

declare(strict_types = 1);

namespace Domain\Model;

use Common\Id;
use Domain\Exception\RunAlreadyParticipated;
use Domain\Exception\RunAlreadyStarted;
use Domain\Exception\RunNotParticipated;
use Domain\Exception\RunResultAlreadySaved;
use Domain\Exception\RunResultExpired;
use Domain\Exception\TimeLimitReached;

final class Runner extends User
{
    const RUN_RESULT_EXPIRY_DAYS = 5;

    /**
     * @var RunParticipation[]
     */
    private $participations;

    /**
     * @var RunResult[]
     */
    private $results;

    public function __construct(
        Id $id,
        string $email,
        string $password,
        array $participations = [],
        array $results = []
    ) {
        $this->participations = $participations;
        $this->results = $results;

        parent::__construct(
            $id,
            $email,
            $password
        );
    }

    /**
     * @return RunParticipation[]
     */
    public function getParticipations(): array
    {
        return $this->participations;
    }

    /**
     * @return RunResult[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @return RunParticipation
     * @throws RunAlreadyParticipated
     * @throws RunAlreadyStarted
     */
    public function participate(Run $run): RunParticipation
    {
        if (isset($this->participations[(string)$run->getId()])) {
            throw RunAlreadyParticipated::forRun($run, $this);
        }

        if ($run->getStartAt() < new \DateTime()) {
            throw RunAlreadyStarted::forRun($run);
        }

        $runParticipation = new RunParticipation($run, $this->getId());
        $this->participations[] = $runParticipation;

        return $runParticipation;
    }

    /**
     * @throws RunNotParticipated
     * @throws RunResultAlreadySaved
     * @throws RunResultExpired
     * @throws TimeLimitReached
     */
    public function result(Run $run, int $time): RunResult
    {
        if (!isset($this->participations[(string)$run->getId()])) {
            throw RunNotParticipated::forRun($run, $this);
        }

        if ($run->getStartAt()->diff(new \DateTime())->d > self::RUN_RESULT_EXPIRY_DAYS) {
            throw RunResultExpired::forRun($run, $this);
        }

        if ($time > $run->getTimeLimit()) {
            throw TimeLimitReached::forRun($run, $this);
        }

        if (isset($this->results[(string)$run->getId()])) {
            throw RunResultAlreadySaved::forRun($run, $this);
        }

        $runResult = new RunResult($run, $this->getId(), $time);
        $this->results[(string)$run->getId()] = $runResult;

        return $runResult;
    }
}
