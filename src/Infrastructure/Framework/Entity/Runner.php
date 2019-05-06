<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Entity;

use Common\Id;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="runners")
 */
final class Runner extends User
{
    const RUN_RESULT_EXPIRY_DAYS = 5;

    /**
     * @var RunParticipation[]
     * @ORM\OneToMany(targetEntity="RunParticipation", mappedBy="runner")
     */
    private $participations;

    /**
     * @var RunResult[]
     * @ORM\OneToMany(targetEntity="RunResult", mappedBy="runner")
     */
    private $results;

    public function __construct(
        string $id,
        string $email,
        string $password,
        array $participations = [],
        array $results = []
    ) {
        $this->participations = new ArrayCollection($participations);
        $this->results = new ArrayCollection($results);

        parent::__construct(
            $id,
            $email,
            $password
        );
    }

    /**
     * @return RunParticipation[]
     */
    public function getParticipations(): array
    {
        return $this->participations->toArray();
    }

    /**
     * @return RunResult[]
     */
    public function getResults(): array
    {
        return $this->results->toArray();
    }
}
