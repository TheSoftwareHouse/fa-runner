<?php

declare(strict_types = 1);

namespace Domain\Model;

use Common\Id;

final class Run
{
    private $id;

    private $name;

    /**
     * Time limit in seconds
     */
    private $timeLimit;

    private $startAt;

    private $type;

    /**
     * Length in meters
     */
    private $length;

    public function __construct(
        Id $id,
        string $name,
        int $timeLimit,
        \DateTime $startAt,
        RunType $type,
        int $length
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->timeLimit = $timeLimit;
        $this->startAt = $startAt;
        $this->type = $type;
        $this->length = $length;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTimeLimit(): int
    {
        return $this->timeLimit;
    }

    public function getStartAt(): \DateTime
    {
        return $this->startAt;
    }

    public function getType(): RunType
    {
        return $this->type;
    }

    public function getLength(): int
    {
        return $this->length;
    }
}
