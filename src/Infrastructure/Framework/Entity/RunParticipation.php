<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Entity;

use Common\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="run_participations")
 */
final class RunParticipation
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Run", cascade={"persist"})
     */
    private $run;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Runner", inversedBy="participations", cascade={"persist"})
     */
    private $runner;

    public function __construct(Run $run, Runner $runner)
    {
        $this->run = $run;
        $this->runner = $runner;
    }

    public function getRun(): Run
    {
        return $this->run;
    }

    public function getRunnerId(): string
    {
        return $this->runner->getId();
    }
}
