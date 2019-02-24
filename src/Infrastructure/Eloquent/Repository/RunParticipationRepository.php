<?php

declare(strict_types = 1);

namespace Infrastructure\Eloquent\Repository;

use Domain\Model\RunParticipation;
use Infrastructure\Eloquent\Transformer\RunParticipationTransformer;

class RunParticipationRepository implements \Domain\Repository\RunParticipationRepository
{
    private $runParticipationTransformer;

    public function __construct(RunParticipationTransformer $runParticipationTransformer)
    {
        $this->runParticipationTransformer = $runParticipationTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function save(RunParticipation $runParticipation): void
    {
        $dbRunParticipation = $this->runParticipationTransformer->domainToEntity($runParticipation);

        $dbRunParticipation->save();
    }
}
