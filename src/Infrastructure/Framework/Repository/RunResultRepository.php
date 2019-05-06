<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Model\RunResult;
use Infrastructure\Doctrine\Transformer\RunResultTransformer;
use Infrastructure\Framework\Entity\RunResult as RunResultEntity;

class RunResultRepository implements \Domain\Repository\RunResultRepository
{
    private $entityManager;

    private $entityRepository;

    private $runResultTransformer;

    public function __construct(EntityManagerInterface $entityManager, RunResultTransformer $runResultTransformer)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository(RunResultEntity::class);
        $this->runResultTransformer = $runResultTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function save(RunResult $runResult): void
    {
        $dbRunParticipation = $this->runResultTransformer->domainToEntity($runResult);

        $this->entityManager->persist($dbRunParticipation);
        $this->entityManager->flush();
    }
}
