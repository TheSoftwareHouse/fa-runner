<?php

namespace Domain\Repository;

use Domain\Model\RunResult;

interface RunResultRepository
{
    public function save(RunResult $runResult): void;
}
