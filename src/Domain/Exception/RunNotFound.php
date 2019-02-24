<?php

declare(strict_types = 1);

namespace Domain\Exception;

use Common\Id;

final class RunNotFound extends DomainException
{
    public static function forId(Id $id): self
    {
        return new self(
            sprintf("Run with id %s not found", $id)
        );
    }
}
