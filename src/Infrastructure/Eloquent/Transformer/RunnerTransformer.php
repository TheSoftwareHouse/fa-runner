<?php

declare(strict_types = 1);

namespace Infrastructure\Eloquent\Transformer;

use Infrastructure\Eloquent\Model\Runner as Entity;
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
        $dbParticipations = $entity->participations()->get();
        $dbResults = $entity->results()->get();
        $runnerId = \Common\Id::create($entity->id);
        $participations = $this->runParticipationTransformer->entityToDomainMany($dbParticipations);
        $results = $this->runResultTransformer->entityToDomainMany($dbResults);

        return new Domain($runnerId, $entity->email, $entity->password, $participations, $results);
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
