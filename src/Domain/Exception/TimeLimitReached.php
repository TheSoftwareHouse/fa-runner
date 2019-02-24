<?php

declare(strict_types = 1);

namespace Domain\Exception;

use Domain\Model\Run;
use Domain\Model\Runner;

final class TimeLimitReached extends DomainException
{
    public static function forRun(Run $run, Runner $runner): self
    {
        return new self(
            sprintf("Runner %s reached time limit in run %s", $runner->getId(), $run->getId())
        );
    }
}
