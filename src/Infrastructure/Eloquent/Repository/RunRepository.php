<?php

declare(strict_types = 1);

namespace Infrastructure\Eloquent\Repository;

use Common\Id;
use Domain\Exception\RunNotFound;
use Domain\Model\Run;
use Infrastructure\Eloquent\Transformer\RunTransformer;

class RunRepository implements \Domain\Repository\RunRepository
{
    private $runTransformer;

    public function __construct(RunTransformer $runTransformer)
    {
        $this->runTransformer = $runTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(Id $runId): Run
    {
        $run = \Infrastructure\Eloquent\Model\Run::find((string)$runId);

        if (null === $run) {
            throw RunNotFound::forId($runId);
        }

        return $this->runTransformer->entityToDomain($run);
    }
}
