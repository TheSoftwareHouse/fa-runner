<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Repository;

use Common\Id;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Exception\RunnerNotFound;
use Domain\Model\Runner;
use Infrastructure\Doctrine\Transformer\RunnerTransformer;

class RunnerRepository implements \Domain\Repository\RunnerRepository
{
    private $entityManager;

    private $entityRepository;

    private $runnerTransformer;

    public function __construct(EntityManagerInterface $entityManager, RunnerTransformer $runnerTransformer)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository(\Infrastructure\Framework\Entity\Runner::class);
        $this->runnerTransformer = $runnerTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(Id $runnerId): Runner
    {
        $runner = $this->entityRepository->find((string)$runnerId);

        if (null === $runner) {
            throw RunnerNotFound::forId($runnerId);
        }

        return $this->runnerTransformer->entityToDomain($runner);
    }
}
