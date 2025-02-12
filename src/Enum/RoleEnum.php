<?php

namespace App\Enum;

enum RoleEnum: string
{
    case USER = 'ROLE_USER';
    case ADMIN = 'ROLE_ADMIN';
}

class User
{
    private $roles = [];

    public function __construct()
    {
        $this->roles[] = RoleEnum::USER->value;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getUserIdentifier(): string
    {
        return $this->roles[0];
    }
}
