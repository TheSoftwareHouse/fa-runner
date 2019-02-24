<?php

declare(strict_types = 1);

namespace Infrastructure\Eloquent\Transformer;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Model\RunParticipation as Entity;
use Domain\Model\RunParticipation as Domain;

class RunParticipationTransformer
{
    private $runTransformer;

    public function __construct(RunTransformer $runTransformer)
    {
        $this->runTransformer = $runTransformer;
    }

    /**
     * @throws \Common\Exception\InvalidIdException
     * @throws \Domain\Exception\InvalidRunType
     */
    public function entityToDomain(Entity $entity): Domain
    {
        $dbRun = $entity->run()->get()->pop();
        $runnerId = \Common\Id::create($entity->runner_id);
        $run = $this->runTransformer->entityToDomain($dbRun);

        return new Domain($run, $runnerId);
    }

    /**
     * @throws \Common\Exception\InvalidIdException
     * @throws \Domain\Exception\InvalidRunType
     */
    public function entityToDomainMany(Collection $entities): array
    {
        $domains = [];

        foreach ($entities as $entity) {
            $domains[$entity->run_id] = $this->entityToDomain($entity);
        }

        return $domains;
    }

    public function domainToEntity(Domain $domain): Entity
    {
        $run = $domain->getRun();

        $entity = new Entity();
        $entity->run_id = (string)$run->getId();
        $entity->runner_id = (string)$domain->getRunnerId();

        return $entity;
    }
}
