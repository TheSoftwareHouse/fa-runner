<?php

declare(strict_types = 1);

namespace Infrastructure\Eloquent\Transformer;

use Infrastructure\Eloquent\Model\Run as Entity;
use Domain\Model\Run as Domain;

class RunTransformer
{
    /**
     * @throws \Common\Exception\InvalidIdException
     * @throws \Domain\Exception\InvalidRunType
     */
    public function entityToDomain(Entity $entity): Domain
    {
        return new Domain(
            \Common\Id::create($entity->id),
            $entity->name,
            $entity->time_limit,
            $entity->start_at,
            \Domain\Model\RunType::fromString($entity->type),
            $entity->length
        );
    }

    public function domainToEntity(Domain $domain): Entity
    {
        $entity = new Entity();
        $entity->id = (string)$domain->getId();
        $entity->name = $domain->getName();
        $entity->time_limit = $domain->getTimeLimit();
        $entity->start_at = $domain->getStartAt();
        $entity->type = (string)$domain->getType();
        $entity->length = $domain->getLength();

        return $entity;
    }
}
