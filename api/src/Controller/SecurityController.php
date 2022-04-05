<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use App\Entity\BlacklistedToken;

class SecurityController extends AbstractController
{
    private $jwtManager;

    public function __construct(JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }

    /**
     * @Route("/api/login", name="app_login", methods={"POST"})
     */
    public function login()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $token = $this->jwtManager->create($user);

        return $this->json([
            'user' => $this->getUser() ? $this->getUser() : null,
            'token' => $token
        ]);
    }
}