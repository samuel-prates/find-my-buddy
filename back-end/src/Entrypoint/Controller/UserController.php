<?php

namespace Fmb\Entrypoint\Controller;

use Fmb\App\Service\UserService;
use Fmb\Infra\Database\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use UserSerializer;

final class UserController extends AbstractController
{
    #[Route('/api/users', name: 'user_list', methods: ['GET'])]
    public function list(UserService $userService): JsonResponse
    {
        $users = $userService->getUserList();
        
        return $this->json([
            'users' => UserSerializer::serialize($users)
        ]);
    }

    #[Route('/api/users/{id}', name: 'user_by_id', methods: ['GET'])]
    public function user(int $id, UserService $userService): JsonResponse
    {
        return $this->json(UserSerializer::serialize($userService->getUserById($id)));
    }
}
