<?php

namespace Domain\Repository;

use Domain\Model\RunParticipation;

interface RunParticipationRepository
{
    public function save(RunParticipation $runParticipation): void;
}
