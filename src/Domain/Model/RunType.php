<?php

declare(strict_types = 1);

namespace Domain\Model;

use Domain\Exception\InvalidRunType;

final class RunType
{
    const TYPE_MARATHON = 'marathon';
    const TYPE_HALF_MARATHON = 'half_marathon';
    const TYPE_QUARTER_MARATHON = 'quarter_marathon';
    const TYPE_OTHER = 'other';

    const ALLOWED_TYPES = [
        self::TYPE_MARATHON,
        self::TYPE_HALF_MARATHON,
        self::TYPE_QUARTER_MARATHON,
        self::TYPE_OTHER,
    ];

    private $type;

    /**
     * @throws InvalidRunType
     */
    public static function fromString(string $type): self
    {
        if (!in_array($type, self::ALLOWED_TYPES)) {
            throw InvalidRunType::forType($type);
        }

        return new self($type);
    }

    private function __construct(string $type)
    {
        $this->type = $type;
    }

    public function __toString(): string
    {
        return $this->type;
    }
}
