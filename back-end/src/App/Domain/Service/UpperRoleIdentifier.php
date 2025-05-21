<?php

namespace App\Domain\Service;

use Fmb\App\Domain\Entity\Enum\RolesEnum;

class UpperRoleIdentifier
{
    /**
     * Return the upper-level role.
     *
     * @param array $roles
     * @return string
     */
    public function isUpperRole(array $roles): string
    {
        if (in_array(RolesEnum::ADMIN->value, $roles)) {
            return RolesEnum::ADMIN->value;
        }
        return RolesEnum::USER->value;
    }
}
