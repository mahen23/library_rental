<?php
// src/Controller/AuthenticationController.php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManagerInterface;

class AuthenticationController extends AbstractController
{
    private $logger;
    private $passwordHasher;
    private $doctrine;
    private $jwtManager;

    public function __construct(
        LoggerInterface $logger,
        UserPasswordHasherInterface $passwordHasher,
        ManagerRegistry $doctrine,
        JWTManagerInterface $jwtManager // Inject the JWTManager here
    ) {
        $this->logger = $logger;
        $this->passwordHasher = $passwordHasher;
        $this->doctrine = $doctrine;
        $this->jwtManager = $jwtManager; // Assign to the class property
    }

    public function authenticate(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        // Fetch user from the database
        $user = $this->doctrine->getRepository(User::class)->findOneBy(['username' => $username]);

        if (!$user || !$this->passwordHasher->isPasswordValid($user, $password)) {
            return new JsonResponse(['error' => 'Invalid credentials'], 401);
        }

        // Generate JWT token
        $token = $this->jwtManager->create($user);

        return new JsonResponse(['token' => $token]);
    }
}
