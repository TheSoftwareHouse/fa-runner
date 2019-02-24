<?php

declare(strict_types = 1);

namespace Domain\Model;

use Common\Id;

final class RunParticipation
{
    private $run;

    private $runnerId;

    public function __construct(Run $run, Id $runnerId)
    {
        $this->run = $run;
        $this->runnerId = $runnerId;
    }

    public function getRun(): Run
    {
        return $this->run;
    }

    public function getRunnerId(): Id
    {
        return $this->runnerId;
    }
}
