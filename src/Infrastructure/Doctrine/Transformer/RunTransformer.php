<?php

declare(strict_types = 1);

namespace Infrastructure\Doctrine\Transformer;

use Infrastructure\Framework\Entity\Run as Entity;
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
            \Common\Id::create($entity->getId()),
            $entity->getName(),
            $entity->getTimeLimit(),
            $entity->getStartAt(),
            \Domain\Model\RunType::fromString($entity->getType()),
            $entity->getLength()
        );
    }

    public function domainToEntity(Domain $domain): Entity
    {
        return new Entity(
            (string)$domain->getId(),
            $domain->getName(),
            $domain->getTimeLimit(),
            $domain->getStartAt(),
            (string)$domain->getType(),
            $domain->getLength()
        );
    }
}
