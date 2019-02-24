<?php

declare(strict_types = 1);

namespace Infrastructure\Eloquent\Repository;

use Common\Id;
use Domain\Exception\RunnerNotFound;
use Domain\Model\Runner;
use Infrastructure\Eloquent\Transformer\RunnerTransformer;

class RunnerRepository implements \Domain\Repository\RunnerRepository
{
    private $runnerTransformer;

    public function __construct(RunnerTransformer $runnerTransformer)
    {
        $this->runnerTransformer = $runnerTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(Id $runnerId): Runner
    {
        $runner = \Infrastructure\Eloquent\Model\Runner::find((string)$runnerId);

        if (null === $runner) {
            throw RunnerNotFound::forId($runnerId);
        }

        return $this->runnerTransformer->entityToDomain($runner);
    }
}
