<?php

declare(strict_types = 1);

namespace Infrastructure\Doctrine\Transformer;

use Doctrine\ORM\EntityManagerInterface;
use Infrastructure\Framework\Entity\Run;
use Infrastructure\Framework\Entity\Runner;
use Infrastructure\Framework\Entity\RunResult as Entity;
use Domain\Model\RunResult as Domain;

class RunResultTransformer
{
    private $runTransformer;

    private $entityManager;

    public function __construct(RunTransformer $runTransformer, EntityManagerInterface $entityManager)
    {
        $this->runTransformer = $runTransformer;
        $this->entityManager = $entityManager;
    }

    /**
     * @throws \Common\Exception\InvalidIdException
     * @throws \Domain\Exception\InvalidRunType
     */
    public function entityToDomain(Entity $entity): Domain
    {
        $dbRun = $entity->getRun();
        $runnerId = \Common\Id::create($entity->getRunnerId());

        $run = $this->runTransformer->entityToDomain($dbRun);

        return new Domain($run, $runnerId, $entity->getTime());
    }

    /**
     * @throws \Common\Exception\InvalidIdException
     * @throws \Domain\Exception\InvalidRunType
     */
    public function entityToDomainMany(array $entities): array
    {
        $domains = [];

        foreach ($entities as $entity) {
            $domains[$entity->getRunId()] = $this->entityToDomain($entity);
        }

        return $domains;
    }

    public function domainToEntity(Domain $domain): Entity
    {
        $run = $this->entityManager->getReference(Run::class, (string)$domain->getRun()->getId());
        $runner = $this->entityManager->getReference(Runner::class, (string)$domain->getRunnerId());

        return new Entity(
            $run,
            $runner,
            $domain->getTime()
        );
    }
}
