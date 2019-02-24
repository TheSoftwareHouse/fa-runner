<?php

declare(strict_types = 1);

namespace Domain\Exception;

final class InvalidRunType extends DomainException
{
    public static function forType(string $type): self
    {
        return new self(sprintf('String %s is not valid run type', $type));
    }
}
