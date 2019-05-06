<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Model\RunParticipation;
use Infrastructure\Doctrine\Transformer\RunParticipationTransformer;
use Infrastructure\Framework\Entity\RunParticipation as RunParticipationEntity;

class RunParticipationRepository implements \Domain\Repository\RunParticipationRepository
{
    private $entityManager;

    private $entityRepository;

    private $runParticipationTransformer;

    public function __construct(EntityManagerInterface $entityManager, RunParticipationTransformer $runParticipationTransformer)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository(RunParticipationEntity::class);
        $this->runParticipationTransformer = $runParticipationTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function save(RunParticipation $runParticipation): void
    {
        $dbRunParticipation = $this->runParticipationTransformer->domainToEntity($runParticipation);

        $this->entityManager->persist($dbRunParticipation);
        $this->entityManager->flush();
    }
}
