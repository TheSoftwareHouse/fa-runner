<?php

namespace Domain\Repository;

use Common\Id;
use Domain\Exception\RunnerNotFound;
use Domain\Model\Runner;

interface RunnerRepository
{
    /**
     * @throws RunnerNotFound
     */
    public function getById(Id $runnerId): Runner;
}
