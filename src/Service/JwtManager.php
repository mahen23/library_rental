<?php
// src/Service/JwtManager.php

namespace App\Service;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManagerInterface;
use App\Entity\User;

class JwtManager
{
    private $jwtManager;

    public function __construct(JWTManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }

    public function create(User $user): string
    {
        return $this->jwtManager->create($user);
    }
}
