<?php

namespace Fmb\App\Service;

use Fmb\Infra\Database\Entity\User;
use Fmb\Infra\Database\Repository\UserRepository;

final class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return User[]
     */
    public function getUserList(): array
    {
        $users = $this->userRepository->findBy([
            'isDeleted' => false,
        ]);
        return $users;
    }

    public function getUserById($id): ?User
    {
        $user = $this->userRepository->find($id);
        return $user;
    }
}
