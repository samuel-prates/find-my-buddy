<?php

namespace  Fmb\Entrypoint\Controller;

use Fmb\App\Domain\Entity\Enum\RolesEnum;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Fmb\App\Service\RegisterUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class RegistrationController extends AbstractController
{
    #[Route('/api/register', name: 'api_register', methods: ['POST']), IsGranted(RolesEnum::USER->value)]
    public function register(
        Request $request,
        JWTTokenManagerInterface $jwtManager,
        RegisterUserService $ruservice
    ): JsonResponse {
        $authorizationHeader = $request->headers->get('Authorization');
        $jwt = str_replace('Bearer ', '', $authorizationHeader);
        $dataToken = $jwtManager->parse($jwt);
        $data = json_decode($request->getContent(), true);

        $user = $ruservice->createUser($data, $dataToken['roles']);

        return $this->json(['message' => 'Usuário registrado com sucesso!', 'user' => $user]);
    }
}
