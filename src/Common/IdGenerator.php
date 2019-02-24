<?php

namespace Common;

use Common\Exception\InvalidIdException;

interface IdGenerator
{
    /**
     * @throws InvalidIdException
     */
    public function generate(): Id;
}
