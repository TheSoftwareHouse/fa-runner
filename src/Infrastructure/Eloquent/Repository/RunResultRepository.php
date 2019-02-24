<?php

declare(strict_types = 1);

namespace Infrastructure\Eloquent\Repository;

use Domain\Model\RunResult;
use Infrastructure\Eloquent\Transformer\RunResultTransformer;

class RunResultRepository implements \Domain\Repository\RunResultRepository
{
    private $runResultTransformer;

    public function __construct(RunResultTransformer $runResultTransformer)
    {
        $this->runResultTransformer = $runResultTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function save(RunResult $runResult): void
    {
        $dbRunResult = $this->runResultTransformer->domainToEntity($runResult);

        $dbRunResult->save();
    }
}
