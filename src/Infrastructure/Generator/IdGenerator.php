<?php

declare(strict_types = 1);

namespace Infrastructure\Generator;

use Common\Id;
use Ramsey\Uuid\Uuid;

class IdGenerator implements \Common\IdGenerator
{
    /**
     * @throws \Common\Exception\InvalidIdException
     */
    public function generate(): Id
    {
        return Id::create((string)Uuid::uuid4());
    }
}
