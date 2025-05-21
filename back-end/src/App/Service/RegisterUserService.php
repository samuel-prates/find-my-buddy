<?php

namespace Fmb\App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Fmb\App\Domain\Entity\Enum\RolesEnum;
use Fmb\App\Domain\Service\RolesFactory;
use Fmb\Infra\Database\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserService
{
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;
    }

    public function createUser(array $data, $userRoles): User
    {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setRoles(RolesFactory::build(RolesEnum::from($data['role']), $userRoles));
        $user->setName($data['name']);
        $user->setPassword($this->passwordHasher->hashPassword($user, $data['password']));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
