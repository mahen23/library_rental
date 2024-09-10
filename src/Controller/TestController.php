<?php
// src/Controller/TestController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TestController extends AbstractController
{
    /**
     * @Route("/api/test", name="api_test", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function test(): Response
    {
        // If the token is valid, display a simple HTML page
        $htmlContent = '<html><body><h1>Token is valid! Welcome to the protected page.</h1></body></html>';

        return new Response($htmlContent);
    }
}
