<?php

declare(strict_types = 1);

namespace Domain\Model;

use Common\Id;

final class RunResult
{
    private $run;

    private $runnerId;

    /**
     * Time in seconds
     */
    private $time;

    public function __construct(Run $run, Id $runnerId, int $time)
    {
        $this->run = $run;
        $this->runnerId = $runnerId;
        $this->time = $time;
    }

    public function getRun(): Run
    {
        return $this->run;
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
