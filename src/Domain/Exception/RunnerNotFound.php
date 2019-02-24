<?php

declare(strict_types = 1);

namespace Domain\Exception;

use Common\Id;

final class RunnerNotFound extends DomainException
{
    public static function forId(Id $id): self
    {
        return new self(
            sprintf("Runner with id %s not found", $id)
        );
    }
}
