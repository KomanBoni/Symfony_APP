<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(UserRepository $userRepository): JsonResponse
    {
        // Test de récupération de tous les utilisateurs
        $users = $userRepository->findAll();
        
        $usersData = [];
        foreach ($users as $user) {
            $usersData[] = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'created_at' => $user->getCreatedAt()?->format('Y-m-d H:i:s'),
                'roles' => $user->getRoles(),
            ];
        }
        
        return $this->json([
            'status' => 'success',
            'message' => 'Connexion à la base de données réussie !',
            'total_users' => count($users),
            'users' => $usersData,
        ]);
    }
    
    #[Route('/test/user/{id}', name: 'app_test_user')]
    public function getUserById(int $id, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->find($id);
        
        if (!$user) {
            return $this->json([
                'status' => 'error',
                'message' => 'Utilisateur non trouvé',
            ], 404);
        }
        
        return $this->json([
            'status' => 'success',
            'user' => [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'created_at' => $user->getCreatedAt()?->format('Y-m-d H:i:s'),
                'roles' => $user->getRoles(),
            ],
        ]);
    }
}
