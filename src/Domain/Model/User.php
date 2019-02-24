<?php

declare(strict_types = 1);

namespace Domain\Model;

use Common\Id;

class User
{
    private $id;

    private $email;

    private $password;

    public function __construct(Id $id, string $email, string $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
