<?php

declare(strict_types = 1);

namespace Application\Command;

use Common\Id;

final class SaveRunnerResult
{
    private $runId;

    private $runnerId;

    private $time;

    public function __construct(Id $runId, Id $runnerId, int $time)
    {
        $this->runId = $runId;
        $this->runnerId = $runnerId;
        $this->time = $time;
    }

    public function getRunId(): Id
    {
        return $this->runId;
    }

    public function getRunnerId(): Id
    {
        return $this->runnerId;
    }

    public function getTime(): int
    {
        return $this->time;
    }
}
