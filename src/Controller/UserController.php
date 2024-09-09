<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/users', name: 'user_list')]
    public function list(ApiService $apiService): Response
    {
        try {
            $users = $apiService->fetchUsers();
        } catch (\Exception $e) {
            // Handle the exception gracefully
            return new Response('Error fetching users: ' . $e->getMessage(), 500);
        }

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }
}
