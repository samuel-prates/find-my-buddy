<?php

namespace Fmb\App\Domain\Service;

use Fmb\App\Domain\Entity\Enum\RolesEnum;
use Doctrine\Common\Collections\ArrayCollection;

class RolesFactory
{
    public static function build(RolesEnum $roleEnum, mixed $userRoles): array
    {
        $roles = new ArrayCollection();

        switch ($roleEnum) {
            case RolesEnum::ADMIN:
                in_array(RolesEnum::ADMIN->value, $userRoles) && $roles->add(RolesEnum::ADMIN->value);
                break;
            default:
                $roles->add(RolesEnum::USER->value);
        }

        return $roles->toArray();
    }
}
