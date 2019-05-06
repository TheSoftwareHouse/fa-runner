<?php

declare(strict_types = 1);

namespace Infrastructure\Doctrine\Transformer;

use Infrastructure\Framework\Entity\Runner as Entity;
use Domain\Model\Runner as Domain;

class RunnerTransformer
{
    private $runParticipationTransformer;

    private $runResultTransformer;

    public function __construct(
        RunParticipationTransformer $runParticipationTransformer,
        RunResultTransformer $runResultTransformer
    ) {
        $this->runParticipationTransformer = $runParticipationTransformer;
        $this->runResultTransformer = $runResultTransformer;
    }

    /**
     * @throws \Common\Exception\InvalidIdException
     * @throws \Domain\Exception\InvalidRunType
     */
    public function entityToDomain(Entity $entity): Domain
    {
        $dbParticipations = $entity->getParticipations();
        $dbResults = $entity->getResults();
        $runnerId = \Common\Id::create($entity->getId());

        $participations = $this->runParticipationTransformer->entityToDomainMany($dbParticipations);
        $results = $this->runResultTransformer->entityToDomainMany($dbResults);

        return new Domain($runnerId, $entity->getEmail(), $entity->getPassword(), $participations, $results);
    }

    public function domainToEntity(Domain $domain): Entity
    {
        $run = $domain->getRun();
        $entity = new Entity();
        $entity->run_id = (string)$run->getId();
        $entity->runnerId = (string)$domain->getRunnerId();
        $entity->time = $domain->getTime();

        return $entity;
    }
}