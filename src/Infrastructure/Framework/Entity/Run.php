<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Entity;

use Common\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="runs")
 */
final class Run
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * Time limit in seconds
     * @ORM\Column(type="integer", nullable=false)
     */
    private $timeLimit;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $startAt;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $type;

    /**
     * Length in meters
     * @ORM\Column(type="integer", nullable=false)
     */
    private $length;

    public function __construct(
        string $id,
        string $name,
        int $timeLimit,
        \DateTime $startAt,
        string $type,
        int $length
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->timeLimit = $timeLimit;
        $this->startAt = $startAt;
        $this->type = $type;
        $this->length = $length;
    }

    public function getId(): string
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

    public function getType(): string
    {
        return $this->type;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function __toString()
    {
        return $this->id;
    }
}
