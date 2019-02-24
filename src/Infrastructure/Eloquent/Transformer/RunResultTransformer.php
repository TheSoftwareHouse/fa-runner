<?php

declare(strict_types = 1);

namespace Infrastructure\Eloquent\Transformer;

use Illuminate\Database\Eloquent\Collection;
use Infrastucture\Eloquent\Model\RunResult as Entity;
use Domain\Model\RunResult as Domain;

class RunResultTransformer
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

        return new Domain($run, $runnerId, $entity->time);
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
        $entity->time = $domain->getTime();

        return $entity;
    }
}
