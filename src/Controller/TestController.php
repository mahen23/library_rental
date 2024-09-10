<?php
// src/Controller/TestController.php
namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    private $jwtTokenManager;

    public function __construct(JWTTokenManagerInterface $jwtTokenManager)
    {
        $this->jwtTokenManager = $jwtTokenManager;
    }

    /**
     * @Route("/test", name="test")
     */
    public function index(Request $request): Response
    {
        // Retrieve the token from the Authorization header
        $authorizationHeader = $request->headers->get('Authorization');

        if ($authorizationHeader) {
            $token = str_replace('Bearer ', '', $authorizationHeader);

            try {
                // Validate and decode the token
                $data = $this->jwtTokenManager->parse($token);
                
                // Check if the token is valid
                if ($data) {
                    return new Response('<html><body><h1>Token is valid</h1></body></html>');
                }
            } catch (\Exception $e) {
                // Handle token validation exceptions
                return new Response('<html><body><h1>Access Denied</h1></body></html>');
            }
        }

        // If the token is not present or invalid
        return new Response('<html><body><h1>Access Denied</h1></body></html>');
    }
}
