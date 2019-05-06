<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Repository;

use Common\Id;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Exception\RunNotFound;
use Domain\Model\Run;
use Infrastructure\Doctrine\Transformer\RunTransformer;

class RunRepository implements \Domain\Repository\RunRepository
{
    private $entityManager;

    private $entityRepository;

    private $runTransformer;

    public function __construct(EntityManagerInterface $entityManager, RunTransformer $runTransformer)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository(\Infrastructure\Framework\Entity\Run::class);
        $this->runTransformer = $runTransformer;
    }

    public function getById(Id $id): Run
    {
        $run = $this->entityRepository->find((string)$id);

        if (null === $run) {
            throw RunNotFound::forId($id);
        }

        return $this->runTransformer->entityToDomain($run);
    }
}
