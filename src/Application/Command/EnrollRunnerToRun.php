<?php

declare(strict_types = 1);

namespace Application\Command;

use Common\Id;

final class EnrollRunnerToRun
{
    private $runnerId;

    private $runId;

    public function __construct(Id $runnerId, Id $runId)
    {
        $this->runnerId = $runnerId;
        $this->runId = $runId;
    }

    public function getRunnerId(): Id
    {
        return $this->runnerId;
    }

    public function getRunId(): Id
    {
        return $this->runId;
    }
}
