<?php

namespace Common;

use Common\Exception\InvalidIdException;

final class Id
{
    private $id;

    /**
     * @throws InvalidIdException
     */
    public static function create(string $id): self
    {
        self::isValidUuid($id);

        return new self($id);
    }

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __toString()
    {
        return $this->id;
    }

    /**
     * @throws InvalidIdException
     */
    private static function isValidUuid(string $id)
    {
        if (!preg_match('/^\{?[A-Fa-f0-9]{8}-[A-Fa-f0-9]{4}-[A-Fa-f0-9]{4}-[A-Fa-f0-9]{4}-[A-Fa-f0-9]{12}\}?$/', $id)) {
            throw InvalidIdException::forId($id);
        }
    }
}
