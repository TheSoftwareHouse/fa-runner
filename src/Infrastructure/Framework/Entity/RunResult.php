<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Entity;

use Common\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="run_results")
 */
final class RunResult
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Run", cascade={"persist"})
     */
    private $run;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Runner", inversedBy="results", cascade={"persist"})
     */
    private $runner;

    /**
     * Time in seconds
     * @ORM\Column(type="integer", nullable=false)
     */
    private $time;

    public function __construct(Run $run, Runner $runner, int $time)
    {
        $this->run = $run;
        $this->runner = $runner;
        $this->time = $time;
    }

    public function getRun(): Run
    {
        return $this->run;
    }

    public function getRunnerId(): string
    {
        return $this->runner->getId();
    }

    public function getTime(): int
    {
        return $this->time;
    }
}
