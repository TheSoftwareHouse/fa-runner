<?php

declare(strict_types = 1);

namespace Domain\Exception;

use Domain\Model\Run;

final class RunAlreadyStarted extends DomainException
{
    public static function forRun(Run $run): self
    {
        return new self(
            sprintf('Runner cannot participate in run %s because it already started', $run->getId())
        );
    }
}
