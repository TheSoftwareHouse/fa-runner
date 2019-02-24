<?php

declare(strict_types = 1);

namespace Domain\Repository;

use Common\Id;
use Domain\Exception\RunNotFound;
use Domain\Model\Run;

interface RunRepository
{
    /**
     * @throws RunNotFound
     */
    public function getById(Id $id): Run;
}
